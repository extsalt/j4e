<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Firebase1 extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        // $this->load->model('admin_model');
    }

    public function index()
    {
        $this->load->library('firebase');
        $factory = $this->firebase->init();
        $db = $factory->getDatabase();
        $auth = $factory->getAuth();
        $avatar = 'https://firebasestorage.googleapis.com/v0/b/j4e-app.appspot.com/o/default_user_img.png?alt=media&token=d65a3232-b36d-4386-8814-c23986808d83';
        $avatar1 = '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\n';
        $email1 = 'radhesh.applex360@gmail.com';
        $mobile1 = '+919673008827';
        $pass = 'Applex@2021';
        $dname = 'Radhesh Kulkarni';
        
        $fdata = [
            'name' => $dname,
            'phone' => $mobile1,
          'photo' => $avatar,
          'status' => 'Hey I am using J4E App',
          'thumbImg' => $avatar1,
          'ver' => '2.1.1'
        ];
        // print_r($fdata);die;
        $ref = "users/";
       
            $postdata = $db->getReference($ref)->push($fdata);
            
            $postKey = $postdata->getKey();
            $userProperties = [
                'uid' => $postKey,
            'phoneNumber' => $mobile1,
            'password' => $pass,
            'displayName' => $dname,
            'photoUrl' => $avatar,
            'disabled' => false,
        ];

        $user = $auth->createUser($userProperties);
        // $fdata1 = [
        //     $mobile1 => $postKey
        // ];
        // $ref1 = "uidByPhone/";
        // $postdata1 = $db->getReference($ref1)->push($fdata1);
        echo $postKey;
        // $data = [
        //   'avata' => 'default',
        //   'email' => 'test1@gmail.com',
        //   'name' => 'Test User 2'
        // ];
        // $ref = "user/";
        // $postdata = $db->getReference($ref)->push($data);
        // if($db)
        // {
        //     echo "Success";
        // }
        // else
        // {
        //     echo "Fail";
        // }
    }


}
