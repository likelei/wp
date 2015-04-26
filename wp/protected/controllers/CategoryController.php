<?php

class CategoryController extends Controller
{
    /**
     * 分类默认首页
     */
	public function actionIndex()
	{
       $connetion = Yii::app()->db ;
        $sql = "SELECT * from co_category";
        $command = $connetion->createCommand($sql);
        $dataResult = $command->query();

        $list = array();
        while(($row=$dataResult->read())){
             $list[$row["id"]]["id"] = $row["id"] ;
            $list[$row["id"]]["name"] = $row["name"] ;
        }

       echo json_encode($list);
	}

    public function actions(){
        return array(
            "captcha2" => array(
                "class"=>'system.web.widgets.captcha.CCaptchaAction',
                "height" => 40 ,
                "width" => 100 ,
                "minLength" => 5,
                "maxLength" => 5,
            )
        );
    }

    public function  actionSave(){
        $id = $_REQUEST["id"];
        $name = $_REQUEST["name"];
        // 绑定参数
        $connection = Yii::app()->db ;
        $sql="INSERT INTO co_category (id,name) VALUES(:id,:name)";
        $command=$connection->createCommand($sql);
        // 用实际的用户名替换占位符 ":username"
         $command->bindParam(":id",$id);
        // 用实际的 Email 替换占位符 ":email"
        $command->bindParam(":name",$name);
        $result = null;
        try {
            $result = $command->execute();

        }catch (CDbException $e){
            $result = false ;

        }
        echo $result ;
    }

    public function  actionDelete(){
        $id = $_REQUEST["id"];
        // 绑定参数
        $connection = Yii::app()->db ;
        $sql="delete from co_category where id>:id";
        $command=$connection->createCommand($sql);
        // 用实际的用户名替换占位符 ":username"
        $command->bindParam(":id",$id,PDO::PARAM_INT);

        $result = null;

        $result = $command->execute();

        echo "delete result =".$result ;
    }

    public function  actionQuery(){


        $result = Yii::app()->db->createCommand()

            ->select('id, name')

            ->from('co_category u')
            ->queryAll();

        var_dump($result);
    }

    public function  actionRecordSave(){
        $category = new Category();
        $category->id = 11 ;
        $category->name = "record" ;
        $category->save();
    }

    public function  actionRecordQuery(){
        $dataResult = Product::model()->findAll();

        $list = array();
        foreach($dataResult as $tmp){
            $list[$tmp->id]["id"] = $tmp->id ;
            $list[$tmp->id]["name"] = $tmp->name ;
            $list[$tmp->id]["brand"] = $tmp->brandId ;
        }

        echo json_encode($list);

    }
}