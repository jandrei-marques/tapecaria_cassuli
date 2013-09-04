<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Current_User extends CI_Model {

    private static $user;
    private static $admin;

    public function __construct() {
        parent::__construct();
        $this->load->model("usuario_model");
        date_default_timezone_set("America/Sao_paulo");
    }

    public function user() {
        if (!isset(self::$user)) {
            if (!$user_id = $this->session->userdata('usuario_id')) {
                return FALSE;
            }
            if (!$u = $this->usuario_model->buscarId($user_id)) {
                return FALSE;
            }
            self::$user = $u;
        }
        return self::$user;
    }

    public function isAdmin() {
        if (!isset(self::$admin)) {

            if (!$user_id_ = $this->session->userdata('usuario_id')) {
                return FALSE;
            }
            if (!$user = $this->usuario_model->buscarId($user_id_)) {
                return FALSE;
            }
            if (!$adm = $this->usuario_model->getAdmin($user_id_)) {
                return FALSE;
            }
            self::$admin = $adm;
        }
        return self::$admin;
    }

    public function login($login, $senha) {
        $qr = "select * from usuario where login = ? and senha = ?";
        $q = $this->db->query($qr, array($login, $senha));
        $res = $q->row();
        $cont = count($res);
        if ($cont > 0) {
            $this->session->set_userdata('data_ultimo_acesso',$res->dt_ultimoacesso);
            $user = array(
                'dt_ultimoacesso' => date("Y-m-d H:i:s"),
            );
            $this->usuario_model->atualizar($res->id,$user);
            $CI = & get_instance();
            $CI->load->library('session');
            $CI->session->set_userdata('usuario_id', $res->id);
            self::$user = $res;
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function __clone() {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }
}
/* End of file current_user.php */
/* Location: ./application/models/current_user.php */