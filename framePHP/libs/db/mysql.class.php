<?php
class mysql{
    protected $dbtype,$dbhost,$dbport,$dbname,$dbuser,$dbpsw,$dbcharset;
    private $pdo;
    private function my_err($error){
            echo '<br/>����������ǣ�'.$error->getCode();
            echo '<br/>������ļ��ǣ� ' . $error->getMessage();
            echo '<br/>������к��ǣ� ' . $error->getMessage();
            echo '<br/>�������Ϣ�ǣ� ' . $error->getMessage();
            die("�Բ������Ĳ������󣬴���ԭ��Ϊ��".$error);//die���������� ��� �� ��ֹ   �൱��  echo �� exit �����
    }

    function __construct($config){
                 $dbtype=$config["dbtype"]??"mysql";
                 $dbhost=$config["dbhost"]??"localhost";
                 $dbport=$config["dbport"]??"3306";
                 $dbname=$config["dbname"]??"jjchdata";
                 $dbuser=$config['dbuser']??"jjch";
                 $dbpsw=$config["dbpsw"]??"jjch";
                 $dbcharset=$config["dbcharset"]??"gb18030";
                 $dsn=$dbtype.":host=".$dbhost.":".$dbport.";dbname=".$dbname;
                 try {                   
                     $this->pdo=new PDO($dsn,$dbuser,$dbpsw);
                     $this->pdo->query("set names ".$dbcharset);//ʹ��mysql_query ���ñ���  ��ʽ��mysql_query("set names utf8")
                     $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
                    // $this->pdo->fetch(PDO::FETCH_ASSOC);
                     echo "���ݿ����ӳɹ�";
                 } catch (Exception $ex) {
                     $this->my_err($ex);
                }			
    }
	/**
	 * ִ��sql���
	 *
	 * @param string $sql
	 * @return bool ����ִ�гɹ�����Դ��ִ��ʧ��
	 */
    public function query($sql){
            try {
                $query = $this->pdo->query($sql);
                return $query;
            } catch (Exception $ex) {
                echo "���������ǣ�".$sql;
                $this->my_err($ex);                
            }
    }

	/**
	*�б�
	*
	*@param source $query sql���ͨ��mysql_query ִ�г�������Դ
	*@return array   �����б�����
	**/
    public function findAll($query){
       try{
            $select=$this->pdo->prepare($query);
            $select->execute();
            $res=$select->fetchAll(PDO::FETCH_ASSOC);
            return $res;
       } catch (Exception $ex){
           $this->my_err($ex);
       }   
    }

	/**
	*����
	*
	*@param source $query sql���ͨ��mysql_queryִ�г���������Դ
	*return array   ���ص�����Ϣ����
	**/
    public function findOne($query){
        try{
            $select=$this->pdo->prepare($query);
            $select->execute();
            $res=$select->fetch(PDO::FETCH_ASSOC);
            return $res;
        }catch (Exception $ex){
            $this->my_err($ex);
        }   
    }

	/**
	*ָ���е�ָ���ֶε�ֵ
	*
	*@param source $query sql���ͨ��mysql_queryִ�г���������Դ
	*return array   ����ָ���е�ָ���ֶε�ֵ
	**/
    public function findResult($query, $row = 0, $filed = 0){
        $query1=$query." limit ".$row.",".$filed;
        echo $query1;
        try {
            $select=$this->pdo->prepare($query1);
            $select->execute();
            $res=$select->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } catch (Exception $ex) {
            $this->my_err($ex);
        }
           
    }

	/**
	 * ��Ӻ���
	 *
	 * @param string $table ����
	 * @param array $arr ������飨�����ֶκ�ֵ��һά���飩
	 * 
	 */
    public function insert($table,$arr){
            //$sql = "insert into ����(����ֶ�) values(���ֵ)";          
            foreach($arr as $key=>$value){//foreachѭ������                
                    //$value = mysql_real_escape_string($value);
                    $keyArr[] = "`".$key."`";//��$arr���鵱�еļ������浽$keyArr���鵱��
                    $valueArr[] = "'".$value."'";//��$arr���鵱�еļ�ֵ���浽$valueArr���У���Ϊֵ��Ϊ�ַ�������sql�������insert�������ֵ���ַ����Ļ�Ҫ�ӵ����ţ���������ط�Ҫ���ϵ�����
            }
            $keys = implode(",",$keyArr);//implode�����ǰ�������ϳ��ַ��� implode(�ָ���������)
            $values = implode(",",$valueArr);
            $sql = "insert into ".$table."(".$keys.") values(".$values.")";//sql�Ĳ������  ��ʽ��insert into ��(����ֶ�)values(���ֵ)
            echo "<p>sql����ǣ�".$sql."</p>";
           try{ $this->pdo->query($sql);//�����������query(ִ��)����ִ������sql���  ע��$thisָ������
               $insertid= $this->lastid();
               return $insertid;
           } catch (Exception $ex){
               $this->my_err($ex);
           }
    }
    protected function lastid(){
           $last_id = $this->pdo->query("select last_insert_id()");
           $lastid=$last_id->fetch();
           return $lastid;
    }

    /**
	*�޸ĺ���
	*
	*@param string $table ����
	*@param array $arr �޸����飨�����ֶκ�ֵ��һά���飩
	*@param string $where  ����
	**/
    public function update($table,$arr,$where){
            //update ���� set �ֶ�=�ֶ�ֵ where ����
            foreach($arr as $key=>$value){
                   // $value = mysql_real_escape_string($value);
                    $keyAndvalueArr[] = "`".$key."`='".$value."'";
            }
            $keyAndvalues = implode(",",$keyAndvalueArr);
            $sql = "update ".$table." set ".$keyAndvalues." where ".$where;//�޸Ĳ��� ��ʽ update ���� set �ֶ�=ֵ where ����
            try {
               $count = $this->pdo->query($sql);
               return $count;
            } catch (Exception $ex) {
                $this->my_err($ex);
            }
    }

	/**
	*ɾ������
	*
	*@param string $table ����
	*@param string $where ����
	**/
    public function del($table,$where){
            $sql = "delete from ".$table." where ".$where;//ɾ��sql��� ��ʽ��delete from ���� where ����
            try {
               $count = $this->pdo->query($sql);
               return $count;
            } catch (Exception $ex) {
                $this->my_err($ex);
                        
            }
            
    }

}

?>