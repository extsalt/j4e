<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require __DIR__."/../third_party/firebase/vendor/autoload.php"; 
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
// use Kreait\Firebase\Auth;
class Firebase { 
    protected $serviceAccount;
    public function __construct() { 
        $this->CI =& get_instance();
        $this->serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/../third_party/firebase/j4e-app-firebase-adminsdk-lmgcf-2e89bd5b11.json');
    } 
    public function init()
    {
        return (new Factory)->withServiceAccount(__DIR__.'/../third_party/firebase/j4e-app-firebase-adminsdk-lmgcf-2e89bd5b11.json')->withDatabaseUri('https://j4e-app-default-rtdb.firebaseio.com')->create();
    }
}
