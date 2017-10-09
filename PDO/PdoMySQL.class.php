<?php
class PdoMySQL{
    public static $config = array(); // 设置连接参数，配置信息
    public static $link = null; // 保存连接标识符
    public static $pconnect = false; // 是否开启长链接
    public static $dbVersion = null; // 保存数据库版本
    public static $connected = false; // 是否连接成功
    public static $PDOStatement = null; // 保存PDOStatement对像
    public static $queryStr = null; // 保存最后执行的操作
    public static $error = null; // 保存错误信息
    public static $lastInsertId = null;  // 保存上一步插入操作产生AUTO_INCREMENT
    public static $numRows = 0;  // 上一步操作产生受影响的记录的条数
    
    /**
     * 连接PDO
     * @param string $dbConfig
     * @return boolean
     */
    public function __construct($dbConfig=''){
        if(!class_exists("PDO")){
            self::throw_exception('不支持PDO，请先开启');
        }
        if(!is_array($dbConfig)){
            $dbConfig = array(
              'hostname'=>DB_HOST, 
              'username'=>DB_USER,
              'password'=>DB_PWD,
              'database'=>DB_NAME,
              'hostport'=>DB_PORT,
              'dbms'=>DB_TYPE,
              'dsn'=>DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME
            );
        }
        // 判断是否有主机名
        if(empty($dbConfig['hostname'])){
            self::throw_exception('没有定义数据库配置，请先定义');
        }
        self::$config=$dbConfig;
        if(empty(self::$config['params'])){
            self::$config['params'] = array();
        }
        if(!isset(self::$link)){
            $configs = self::$config;
            if(self::$pconnect){
                // 开启长连接，添加到配置数组中
                $configs['params'][constant("PDO::ATTR_PERSISTENT")] = true;
            }
            try {
               self::$link = new PDO($configs['dsn'],$configs['username'],$configs['password'],$configs['params']); 
            } catch (PDOException $e) {
                self::throw_exception($e->getMessage());
            }
            if(!self::$link){
                self::throw_exception('PDO连接错误');
                return false;
            }
            self::$link->exec('SET NAMES '.DB_CHARSET);
            self::$dbVersion = self::$link->getAttribute(constant("PDO::ATTR_SERVER_VERSION"));
            self::$connected = true;
            unset($configs);
        }
    }
    
    
    /**
     * 得到所有记录
     * @param string $sql
     * @return unknown
     */
    public static function getAll($sql=null){
        if($sql != null){
            self::query($sql);
        }
        $result = self::$PDOStatement->fetchAll(constant("PDO::FETCH_ASSOC"));
        return $result;
    }
    
    /**
     * 执行增删改操作，返回受影响的记录的条数
     * @param string $sql
     * @return boolean|unknown
     */
    public static function execute($sql=null){
        $link = self::$link;
        if(!$link){
            return false;
        }
        self::$queryStr = $sql;
        if(!empty(self::$PDOStatement)){
            self::free();
        }
        $result = $link->exec(self::$queryStr);
        self::haveErrorThrowException();
        if($result){
            self::$lastInsertId = $link->lastInsertId();
            self::$numRows = $result;
            return self::$numRows;
        }else {
            return false;
        }
    }
    
    /**
     * 释放结果集
     */
    public static function free(){
        self::$PDOStatement = null;
    }
  
    /**
     * 
     * @param string $sql
     * @return boolean
     */
    public static function query($sql=''){
        $link = self::$link;
        if(!$link){
            return false;
        }
        // 判断之前是否有结果集，如果有的话，释放结果集
        if(!empty(self::$PDOStatement)){
            self::free();
        }
        self::$queryStr = $sql;
        self::$PDOStatement = $link->prepare(self::$queryStr);
        $res = self::$PDOStatement->execute();
        self::haveErrorThrowException();
        return $res;
    }
    /**
     * 添加记录的操作
     * @param array $data
     * @param string $table
     * @return Ambigous <boolean, unknown, number>
     */
    public static function add($data, $table){
        $keys = array_keys($data);
        array_walk($keys, array('PdoMySQL', 'addSpecialChar'));
        $fieldsStr = join(',', $keys);
        $values = "'".join("','", array_values($data))."'";
        $sql = "INSERT {$table}({$fieldsStr}) VALUES({$values})";
        return self::execute($sql);  
    }
    
    /**
     * 更新记录
     * @param array $data
     * @param string $table
     * @param string $where
     * @param string $order
     * @param string $limit
     * @return Ambigous <boolean, unknown>
     */
    public static function update($data, $table, $where = null, $order = null, $limit = null){
        foreach ($data as $key => $val){
            $sets .= $key ."='" .$val. "',";
        }
        $sets = rtrim($sets, ',');
        $sql = "UPDATE {$table} SET {$sets} ".self::parseWhere($where).self::parseOrder($order).self::parseLimit($limit);
        return self::execute($sql);
    }
    /**
     * 删除记录
     * @param string $table
     * @param string $where
     * @param string $order
     * @param number $limit
     */
    public static function delete($table, $where = null, $order = null, $limit = 0){
        $sql = "DELETE FROM {$table} ".self::parseWhere($where).self::parseOrder($order).self::parseLimit($limit);
        return self::execute($sql);
    }
    
    /**
     * 得到最后执行的SQL语句 
     * @return boolean|Ambigous <string, string>
     */
    public static function getLastSql(){
        $link = self::$link;
        if(!$link){
            return false;
        }else{
            return self::$queryStr;
        }
    }
    /**
     * 得到上一步插入操作产生AUTO_INCREMENT的值
     * @return boolean|string
     */
    public static function getLastInsertId(){
        $link = self::$link;
        if(!$link){
            return false;
        }else{
            return self::$lastInsertId;
        }
    }
    /**
     * 得到数据库的版本
     * @return boolean|mixed
     */
    public static function getDbVersion(){
        $link = self::$link;
        if(!$link){
            return false;
        }else{
            return self::$dbVersion;
        }
    }
    
    /**
     * 得到数据库中有哪些表
     */
    public static function showTables(){
        $tables = array();
        if(self::query("SHOW TABLES")){
            $result = self::getAll();
            foreach ($result as $key => $val){
                $tables[$key] = current($val);
            }
        }
        return $tables;
    }
    
    /**
     * 得到结果集中的一条记录
     * @param string $sql
     * @return mixed
     */
    
    public static function getRow($sql=null){
       if($sql != null){
           self::query($sql);
       }
       $result = self::$PDOStatement->fetch(constant("PDO::FETCH_ASSOC"));
       return $result;
    }
    
    /**
     * 根据主键查找记录
     * @param string $tabName
     * @param int $priId
     * @param string $fields
     */
    public static function findByID($tabName, $priId, $fields='*'){
        $sql = 'SELECT %s FROM %s WHERE id = %d';
        return self::getRow(sprintf($sql, self::parseFields($fields), $tabName, $priId));
    }
    
    
    /**
     * 执行普通查询
     * @param unknown $tables
     * @param string $where
     * @param string $fields
     * @param string $group
     * @param string $having
     * @param string $order
     * @param string $limit
     * @return Ambigous <unknown, unknown>
     */
    public static function find($tables, $where=null, $fields='*', $group=null, $having=null, $order=null, $limit=null) {
        $sql = 'SELECT '.self::parseFields($fields).' FROM '.$tables
        .self::parseWhere($where)
        .self::parseGroup($group)
        .self::parseHaving($having)
        .self::parseOrder($order)
        .self::parseLimit($limit);
        $dataAll = self::getAll($sql);
//         if(count($dataAll) == 1){
//             $rlt = $dataAll[0];
//         }else{
//             $rlt = $dataAll;
//         }
//         return $rlt;
        return count($dataAll) == 1 ? $dataAll[0] : $dataAll;
    }
    
    /**
     * 解析WHERE条件
     * @param unknown $where
     */
    public static function parseWhere($where){
        $whereStr = '';
        if(is_string($where) && !empty($where)){
            $whereStr = $where;
        }
        return empty($whereStr)?'':' WHERE '.$whereStr;
    }
    
    /**
     * 解析group by
     * @param unknown $group
     * @return string
     */
    public static function parseGroup($group){
        $groupStr = '';
        if(is_array($group)){
            $groupStr .= ' GROUP BY '.implode(',', $group);
        }elseif(is_string($group) && !empty($group)){
            $groupStr .= ' GROUP BY '.$group;
        }
        return empty($groupStr)?'':$groupStr;
    }
    
    /**
     * 对分组结果通过Having子句进行二次筛选
     * @param unknown $having
     * @return string
     */
    public static function parseHaving($having){
        $havingStr = '';
        if(is_string($having) && !empty($having)){
            $havingStr .= ' HAVING '.$having;
        }
        return $havingStr;
    }
    
    /**
     * 解析order by
     * @param unknown $order
     * @return string
     */
    public static function parseOrder($order){
        $orderStr = '';
        if(is_array($order)){
            $orderStr .= ' ORDER BY '.join(',', $order);
        }elseif(is_string($order) && !empty($order)){
            $orderStr .= ' ORDER BY '.$order;
        }
        return $orderStr;
    }
    
    /**
     * 解析限制显示条数limit
     * limit 3
     * limit 0,3
     * @param unknown $limit
     * @return unknown
     */
    public static function parseLimit($limit){
        $limitStr = '';
        if(is_array($limit)){
            if(count($limit) > 1){
                $limitStr .= ' LIMIT '.$limit[0].','.$limit[1];
            }else{
                $limitStr = ' LIMIT '.$limit[0];
            }
        }elseif(is_string($limit) && !empty($limit)){
            $limitStr = ' LIMIT '.$limit;
        }
        return $limitStr;
    }
    
    /**
     * 解析字段
     * @param unknown $fields
     * @return string
     */
    public static function parseFields($fields){
        if(is_array($fields)){
            array_walk($fields, array('PdoMySQL', 'addSpecialChar'));
            $fieldsStr = implode(',', $fields);
        }elseif(is_string($fields) && !empty($fields)){
            if(strpos($fields, '`') === false){
                $fields = explode(',', $fields);
                array_walk($fields, array('PdoMySQL', 'addSpecialChar'));
                $fieldsStr = implode(',', $fields);
            }else{
                $fieldsStr = $fields;
            }
        }else{
                $fieldsStr = '*';
        }
         return $fieldsStr;
    }
    
    /**
     * 通过反引号引用字段
     * @param unknown $value
     * @return string
     */
    public static function addSpecialChar(&$value){
        if($value === '*' || strpos($value, '.') !== false || strpos($value, '`') !== false){
            // 不用做处理
        }elseif(strpos($value, '`') === false){
            $value = '`'.trim($value).'`';
        }
        return $value;
    }
    
    /**
     * 
     */
    public static function haveErrorThrowException(){
        $obj = empty(self::$PDOStatement)?self::$link: self::$PDOStatement;
        $arrError = $obj->errorInfo();
        // print_r($arrError);
        if($arrError[0]!='00000'){
            self::$error = 'SQLSTATE '.$arrError[0].'<br/>SQL Error: '.$arrError[2].'<br/>Error SQL: '.self::$queryStr;
            self::throw_exception(self::$error);
            return false;
        }
        if(self::$queryStr == ''){
            self::throw_exception('没有执行SQL语句');
            return false;
        }
    }
    
    /**
     * 自定义错误处理
     * @param unknown $errMsg
     */
    public static function throw_exception($errMsg){
        echo "<div style='width:80%; padding:20px 0; background-color:#abcdef; font-size:20px;'>".$errMsg."</div>";
    }
    
    /**
     * 销毁连接对像
     */
    public static function close(){
        self::$link = null;
    }
  
}
require_once 'config.php';
$PdoMySQL = new PdoMySQL;
// var_dump($PdoMySQL);
// $sql = "SELECT * FROM user";
// print_r($PdoMySQL->getAll($sql));
// $sql = "SELECT  * FROM user WHERE id = 10";
// print_r($PdoMySQL->getRow($sql));

// $sql = "INSERT user(username, password, email) VALUES('ab3','ab3','imooc@imooc.com')";
// var_dump($PdoMySQL->execute($sql));
// echo "<br/>";
// echo $PdoMySQL::$lastInsertId;

// $sql = "UPDATE user SET username = '小新' WHERE id = 55";
// var_dump($PdoMySQL->execute($sql));

// $sql = "DELETE FROM user WHERE id = 53";
// var_dump($PdoMySQL->execute($sql));

// $tabName = 'user' ;
// $priId = 55;
 // $files = 'username, email';
// $files = array('username', 'email');
// print_r($PdoMySQL->findByID($tabName, $priId, $files));

// $tables = 'user';
// echo "<pre>";
// print_r($PdoMySQL->find($tables));
// print_r($PdoMySQL->find($tables, 'id > 30'));
// print_r($PdoMySQL->find($tables, 'id > 30', array('username', 'email')));
// print_r($PdoMySQL->find($tables, 'id > 10', '*', 'email'));
// print_r($PdoMySQL->find($tables, 'id > 10', '*', email, 'count(*) > 3'));
// print_r($PdoMySQL->find($tables,null, "*", null, null, 'username DESC, id DESC'));
// print_r($PdoMySQL->find($tables, null, '*', null, null, null, array(3, 5)));

// $data = array(
//   'username' => 'ab3',
//     'password' => 'ab3',
//     'email' => 'imooc@imooc.com'
// );
// print_r($PdoMySQL->add($data, $tables));

// $data = array(
//     'username' => '小明',
//     'password' => 'ss',
//     'email' => 'imooc@imooc.com'
// );
// var_dump($PdoMySQL->update($data, 'user', 'id < 56', 'username DESC', '1'));

// var_dump($PdoMySQL->delete('user', 'id > 55'));
// var_dump($PdoMySQL->delete('user', 'id > 10', 'username DESC', '5'));
// print_r($PdoMySQL->showTables());

