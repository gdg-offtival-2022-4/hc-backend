<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{

    public function index()
    {
        echo "api index page";
    }

    public function image()
    {
        $image_url = $_FILES['image_url'];

        $result = array(
            "image_url" => "https://i.imgur.com/oMdVph0.jpeg"
        );

        echo json_encode($result);
    }

    public function login()
    {
        $this->load->model('all_model');

        $login_member = json_decode($this->input->raw_input_stream, true);

        $user_info = $this->all_model->validate_login($login_member);

        if ($user_info['id'] == $login_member['id'] && $user_info['pw'] == $login_member['pw']) {
            $result = array(
                "user_id" => $user_info["user_id"]
            );
            echo json_encode($result);
        } else {
            echo "fail";
        }
    }

    public function signup()
    {
        $this->load->model('all_model');

        $member_signup = json_decode($this->input->raw_input_stream, true);

        $user_id = $this->all_model->create_user($member_signup);

        $arr = array(
            "user_id" => $user_id
        );

        echo json_encode($arr);
    }

    public function room()
    {
        $this->load->model('all_model');

        $room = json_decode($this->input->raw_input_stream, true);

        $room_id = $this->all_model->create_room($room);

        $arr = array(
            "room_id" => $room_id
        );

        echo json_encode($arr);
    }

    public function main()
    {
        $this->load->model('all_model');

        $main_posts = $this->all_model->get_main_posts();

        echo json_encode($main_posts);
    }

    public function room_join()
    {
        $this->load->model('all_model');

        $room_join = json_decode($this->input->raw_input_stream, true);

        $this->all_model->join_room($room_join);

        echo "success";
    }

    public function room_rank()
    {
        $room_id = $this->input->get("room_id");
        print_r($room_id);
    }

}