<?php
  /**
   * �ļ��ϴ�
   * author:ʦ�ٱ�
   * email :beibeijing163@163.com
   * time :2012/12/09
   */
  class UploadFile{
    private $max_size   = '2000000'; //�����ϴ��ļ��Ĵ�С����Ϊ2M
    private $rand_name   = true;   //�Ƿ�����������
    private $allow_type  = array();  //�����ϴ����ļ���չ��
    private $error     = 0;     //�������
    private $msg      = '';    //��Ϣ
    private $new_name   = '';    //�ϴ�����ļ���
    private $save_path   = '';    //�ļ�����·��
    private $uploaded   = '';    //·��.�ļ���
    private $file     = '';    //�ȴ��ϴ����ļ�
    private $file_type   = array();  //�ļ�����
    private $file_ext   = '';    //�ϴ��ļ�����չ��
    private $file_name   = '';    //�ļ�ԭ����
    private $file_size   = 0;     //�ļ���С
    private $file_tmp_name = '';    //�ļ���ʱ����
     
    /**
     * ���캯������ʼ��
     * @param string $rand_name �Ƿ��������
     * @param string $save_path �ļ�����·��
     * @param string $allow_type �����ϴ�����
        $allow_type��Ϊ����  array('jpg', 'jpeg', 'png', 'gif');
        $allow_type��Ϊ�ַ��� 'jpg|jpeg|png|gif';�м����' ', ',', ';', '|'�ָ�
     */
    public function __construct($rand_name=true, $save_path='./upload/', $allow_type=''){
      $this->rand_name = $rand_name;
      $this->save_path = $save_path;
      $this->allow_type = $this->get_allow_type($allow_type);
    }
     
    /**
     * �ϴ��ļ�
     * ���ϴ��ļ�ǰҪ���Ĺ���
     * (1) ��ȡ�ļ�������Ϣ
     * (2) �ж��ϴ��ļ��Ƿ�Ϸ�
     * (3) �����ļ����·��
     * (4) �Ƿ�������
     * (5) �ϴ����
     * @param array $file �ϴ��ļ�
     *     $file�����$file['name'], $file['size'], $file['error'], $file['tmp_name']
     */
    public function upload_file($file){
      //$this->file   = $file;
      $this->file_name   = $file['name'];
      $this->file_size   = $file['size'];
      $this->error     = $file['error'];
      $this->file_tmp_name = $file['tmp_name'];
       
      $this->ext = $this->get_file_type($this->file_name);
       
      switch($this->error){
        case 0: $this->msg = ''; break;
        case 1: $this->msg = '������php.ini���ļ���С'; break;
        case 2: $this->msg = '������MAX_FILE_SIZE���ļ���С'; break;
        case 3: $this->msg = '�ļ��������ϴ�'; break;
        case 4: $this->msg = 'û���ļ��ϴ�'; break;
        case 5: $this->msg = '�ļ���СΪ0'; break;
        default: $this->msg = '�ϴ�ʧ��'; break;
      }
      if($this->error==0 && is_uploaded_file($this->file_tmp_name)){
        //����ļ�����
        if(in_array($this->ext, $this->allow_type)==false){
          $this->msg = '�ļ����Ͳ���ȷ';
          return false;
        }
        //����ļ���С
        if($this->file_size > $this->max_size){
          $this->msg = '�ļ�����';
          return false;
        }
      }
      $this->set_file_name();
      $this->uploaded = $this->save_path.$this->new_name;
      if(move_uploaded_file($this->file_tmp_name, $this->uploaded)){
        $this->msg = '�ļ��ϴ��ɹ�';
        return true;
      }else{
        $this->msg = '�ļ��ϴ�ʧ��';
        return false;
      }
    }
     
    /**
    * �����ϴ�����ļ���
    * ��ǰ�ĺ�������ԭ��չ��Ϊ���ļ���
    */
    public function set_file_name(){
      if($this->rand_name==true){
        $a = explode(' ', microtime());
        $t = $a[1].($a[0]*1000000);
        $this->new_name = $t.'.'.($this->ext);
      }else{
        $this->new_name = $this->file_name;
      }
    }
     
    /**
    * ��ȡ�ϴ��ļ�����
    * @param string $filename Ŀ���ļ�
    * @return string $ext �ļ�����
    */
    public function get_file_type($filename){
      $ext = pathinfo($filename, PATHINFO_EXTENSION);
      return $ext;
    }
     
    /**
     * ��ȡ���ϴ��ļ�������
     */
    public function get_allow_type($allow_type){
      $s = array();
      if(is_array($allow_type)){
        foreach($allow_type as $value){
          $s[] = $value;
        }
      }else{
        $s = preg_split("/[\s,|;]+/", $allow_type);
      }
      return $s;
    }
     
    //��ȡ������Ϣ
    public function get_msg(){
      return $this->msg;
    }
  }
?>
