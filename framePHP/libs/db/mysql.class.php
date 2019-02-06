<?php
class mysql{
    protected $dbtype,$dbhost,$dbport,$dbname,$dbuser,$dbpsw,$dbcharset;
    private $pdo;
    private function my_err($error){
            echo '<br/>出错的类型是：'.$error->getCode();
            echo '<br/>出错的文件是： ' . $error->getMessage();
            echo '<br/>出错的行号是： ' . $error->getMessage();
            echo '<br/>错误的信息是： ' . $error->getMessage();
            die("对不起，您的操作有误，错误原因为：".$error);//die有两种作用 输出 和 终止   相当于  echo 和 exit 的组合
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
                     $this->pdo->query("set names ".$dbcharset);//使用mysql_query 设置编码  格式：mysql_query("set names utf8")
                     $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
                    // $this->pdo->fetch(PDO::FETCH_ASSOC);
                     echo "数据库链接成功";
                 } catch (Exception $ex) {
                     $this->my_err($ex);
                }			
    }
	/**
	 * 执行sql语句
	 *
	 * @param string $sql
	 * @return bool 返回执行成功、资源或执行失败
	 */
    public function query($sql){
            try {
                $query = $this->pdo->query($sql);
                return $query;
            } catch (Exception $ex) {
                echo "出错的语句是：".$sql;
                $this->my_err($ex);                
            }
    }

	/**
	*列表
	*
	*@param source $query sql语句通过mysql_query 执行出来的资源
	*@return array   返回列表数组
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
	*单条
	*
	*@param source $query sql语句通过mysql_query执行出的来的资源
	*return array   返回单条信息数组
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
	*指定行的指定字段的值
	*
	*@param source $query sql语句通过mysql_query执行出的来的资源
	*return array   返回指定行的指定字段的值
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
	 * 添加函数
	 *
	 * @param string $table 表名
	 * @param array $arr 添加数组（包含字段和值的一维数组）
	 * 
	 */
    public function insert($table,$arr){
            //$sql = "insert into 表名(多个字段) values(多个值)";
            foreach($arr as $key=>$value){//foreach循环数组
                    $value = mysql_real_escape_string($value);
                    $keyArr[] = "`".$key."`";//把$arr数组当中的键名保存到$keyArr数组当中
                    $valueArr[] = "'".$value."'";//把$arr数组当中的键值保存到$valueArr当中，因为值多为字符串，而sql语句里面insert当中如果值是字符串的话要加单引号，所以这个地方要加上单引号
            }
            $keys = implode(",",$keyArr);//implode函数是把数组组合成字符串 implode(分隔符，数组)
            $values = implode(",",$valueArr);
            $sql = "insert into ".$table."(".$keys.") values(".$values.")";//sql的插入语句  格式：insert into 表(多个字段)values(多个值)
           try{ $this->pdo->query($sql);//调用类自身的query(执行)方法执行这条sql语句  注：$this指代自身
            return $this->pdo->mysql_insert_id();
           } catch (Exception $ex){
               $this->my_err($ex);
           }
    }

	/**
	*修改函数
	*
	*@param string $table 表名
	*@param array $arr 修改数组（包含字段和值的一维数组）
	*@param string $where  条件
	**/
    public function update($table,$arr,$where){
            //update 表名 set 字段=字段值 where ……
            foreach($arr as $key=>$value){
                    $value = mysql_real_escape_string($value);
                    $keyAndvalueArr[] = "`".$key."`='".$value."'";
            }
            $keyAndvalues = implode(",",$keyAndvalueArr);
            $sql = "update ".$table." set ".$keyAndvalues." where ".$where;//修改操作 格式 update 表名 set 字段=值 where 条件
            try {
               $count = $this->pdo->query($sql);
               return $count;
            } catch (Exception $ex) {
                $this->my_err($ex);
            }
    }

	/**
	*删除函数
	*
	*@param string $table 表名
	*@param string $where 条件
	**/
    public function del($table,$where){
            $sql = "delete from ".$table." where ".$where;//删除sql语句 格式：delete from 表名 where 条件
            try {
               $count = $this->pdo->query($sql);
               return $count;
            } catch (Exception $ex) {
                $this->my_err($ex);
                        
            }
            
    }

}

?>