<?php
include 'User.php';

class Recipient extends User{

    protected $age;
    protected $occu;
    protected $pow;
    protected $docPath;

    public function __construct($user,$Name,$pwd,$num,$mail,$a,$o,$p,$prf)
    {
        $this->age=$a;
        $this->occu=$o;
        $this->pow=$p;
        $this->docPath=$prf;
        $this->addUser($user,$Name,$pwd,$num,$mail);
        $DB = new Database();
        $DB->insertInto('user_requester',[$user,$a,$o,$p,$prf]);
    }
}
?>

