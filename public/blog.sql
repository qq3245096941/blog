/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : blog

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-07-26 10:27:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for blog_classify
-- ----------------------------
DROP TABLE IF EXISTS `blog_classify`;
CREATE TABLE `blog_classify` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `sort` tinyint(4) NOT NULL DEFAULT '0',
  `introduce` varchar(500) NOT NULL DEFAULT '' COMMENT '简介',
  `url` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_classify
-- ----------------------------
INSERT INTO `blog_classify` VALUES ('2', 'javascript', '9', 'JavaScript一种直译式脚本语言，是一种动态类型、弱类型、基于原型的语言，内置支持类型。它的解释器被称为JavaScript引擎，为浏览器的一部分，广泛用于客户端的脚本语言，最早是在HTML（标准通用标记语言下的一个应用）网页上使用，用来给HTML网页增加动态功能。', 'http://www.w3school.com.cn/js/index.asp');
INSERT INTO `blog_classify` VALUES ('3', 'php', '3', 'PHP即“超文本预处理器”，是一种通用开源脚本语言。PHP是在服务器端执行的脚本语言，与C语言类似，是常用的网站编程语言。PHP独特的语法混合了C、Java、Perl以及 PHP 自创的语法。利于学习，使用广泛，主要适用于Web开发领域。', 'https://www.php.net');
INSERT INTO `blog_classify` VALUES ('6', 'thinkphp5', '10', 'TP5 是一个快捷，简单的基于MVC和面向对象的轻量级PHP开发框架，为WEB应用和API开发提供了强有力的支持。它是基于PHP5.4设计（完美支持PHP7）,支持Composer，实现了惰性加载，也为API开发做了深入的支持。', 'http://www.thinkphp.cn/');
INSERT INTO `blog_classify` VALUES ('7', 'jquery', '8', 'jQuery是一个快速、简洁的JavaScript框架，是继Prototype之后又一个优秀的JavaScript代码库（或JavaScript框架）。jQuery设计的宗旨是“write Less，Do More”，即倡导写更少的代码，做更多的事情。它封装JavaScript常用的功能代码，提供一种简便的JavaScript设计模式，优化HTML文档操作、事件处理、动画设计和Ajax交互。', 'https://jquery.com/');

-- ----------------------------
-- Table structure for blog_comment
-- ----------------------------
DROP TABLE IF EXISTS `blog_comment`;
CREATE TABLE `blog_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nickname` varchar(255) NOT NULL DEFAULT '',
  `ip` varchar(20) NOT NULL DEFAULT '',
  `body` varchar(1000) NOT NULL DEFAULT '',
  `post_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_comment
-- ----------------------------
INSERT INTO `blog_comment` VALUES ('6', '游客1564022741', '127.0.0.1', '这是一条测试评论', '4', '1564022741');
INSERT INTO `blog_comment` VALUES ('7', '游客1564045647', '127.0.0.1', '好东西', '8', '1564045647');
INSERT INTO `blog_comment` VALUES ('8', '游客1564046856', '27.16.168.160', '方便遍历标签', '5', '1564046856');
INSERT INTO `blog_comment` VALUES ('12', '游客1564105731', '127.0.0.1', '123123', '18', '1564105731');

-- ----------------------------
-- Table structure for blog_post
-- ----------------------------
DROP TABLE IF EXISTS `blog_post`;
CREATE TABLE `blog_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '',
  `intro` varchar(150) NOT NULL,
  `placeholder` varchar(255) NOT NULL DEFAULT '',
  `body` text NOT NULL,
  `classify_id` int(11) NOT NULL COMMENT '当前帖子所属分类',
  `comment_array` text NOT NULL,
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_post
-- ----------------------------
INSERT INTO `blog_post` VALUES ('3', '在javascript中嵌入php文件(技巧)', '在特殊情况下，需要将php数组转换成js数组，则会使用此方法', '\\static\\upload\\20190723\\d4bfe129b57e62d8f12708c454cee903.jpg', '>看代码，将php代码注释后，只留下了循环主体\r\n```\r\n<script>\r\n/*{volist name=\'classify_list\' id=\'classify\'}*/\r\n       {value:\'{$classify.post_num}\',name:\'{$classify.name}\'},\r\n/*{/volist}*/\r\n</script>\r\n```\r\n这里为什么要将php代码注释?\r\n***\r\n* 第一、如果在javascript中加上php代码，ESlint会检测出来，会报错，很不美观，而且phpstrom这种智能编辑器在敲击代码时候，会自动补全。有时候反而是反便利。\r\n* 第二、php代码在js中，无论注释与否，都会执行，该循环也会循环，极大的方便了嵌入。\r\n* 第三、只能使用``/**/``，不可使用``//``。\r\n***\r\n###注释方式同样适用于if标签\r\n```\r\n<script>\r\n    /*{if count($classify_list)>0}*/\r\n    let classify_list = JSON.parse(\"{$classify_list|json_encode}\");\r\n    /*{/if}*/\r\n</script>\r\n```\r\n###使用场景\r\n我们在使用EChars.js时，在创建图表时\r\n```\r\n<script type=\"text/javascript\">\r\n        // 基于准备好的dom，初始化echarts实例\r\n        let myChart = echarts.init(document.getElementById(\'post\'));\r\n        myChart.setOption({\r\n            series: [\r\n                {\r\n                    name: \'帖子\',\r\n                    type: \'pie\',\r\n                    radius: \'55%\',\r\n                    center: [\'50%\', \'50%\'],\r\n                    data: [\r\n                        /*{volist name=\'classify_list\' id=\'classify\'}*/\r\n                        {value: \'{$classify.post_num}\', name: \'{$classify.name}\'},\r\n                        /*{/volist}*/\r\n                    ].sort(function (a, b) {\r\n                        return a.value - b.value;\r\n                    }),\r\n                   // ...\r\n            ]\r\n        });\r\n    </script>\r\n```\r\n给图标设置data数据时，必须要使用到ajax，图标才能加载到数据，但是当前html文件是thinkphp模板，并且在后端也没有编写相应的接口，那么就可以使用到这个方法。\r\n![图片](/static/upload/20190724/5d18a4d908d151932e9a11156053f4bd.png)', '6', '', '1563418146', '1563963512');
INSERT INTO `blog_post` VALUES ('4', 'tp5修改器', 'tp5修改器使用的注意事项', '\\static\\upload\\20190723\\1703c15a4117f99f29a3536c40b5c8c1.png', '```\r\nclass Classify extends Model\r\n{\r\n    protected $name = \'classify\';\r\n\r\n    //注意这里\r\n    public function getPostNumAttr($value,$data){\r\n        return count(Post::get([\'classify_id\'=>$data[\'id\']]));\r\n    }\r\n}\r\n```\r\n这里创建了数据表中没有的字段：``post_num``。\r\n***\r\n\r\n* 1、只能当调用User类的方法，这里才会执行。\r\n* 2、只能通过Class的对象调用post_num属性才会执行，例如：\r\n```\r\n$user = User::get(1);\r\n$post_num = $user->post_num;\r\n```\r\n***\r\n###这样是不会执行的\r\n```\r\n<script>\r\n    $list = JSON.plase(\'{$post_list|json_encode}\');\r\n    $list[0][\'post_num\'] //null\r\n</script>\r\n```\r\n修改器定义格外属性，只能通过调用属性方式获取', '6', '', '1563418191', '1563927954');
INSERT INTO `blog_post` VALUES ('5', 'jquery元素遍历器', '元素遍历器，方便对相同元素进行个体操作', '\\static\\upload\\20190723\\c0733e2161b11c2d83b2775364d1dfdc.png', '>元素遍历器 $(\"element\").each(function(index,element)=>{});\r\n```\r\n<div>\r\n   <ul>\r\n      <li>1</li>\r\n      <li>2</li>\r\n      <li>3</li>\r\n      <li>4</li>\r\n      <li>5</li>\r\n   </ul>\r\n</div>\r\n<script>\r\n    $(\'ul li\').each((index,element)=>{\r\n          $(element).html(); //1,2,3,4,5\r\n     })\r\n</script>\r\n```', '7', '', '1563496541', '1563875512');
INSERT INTO `blog_post` VALUES ('8', 'javascript对象遍历', '遍历对象，对于动态增加和删除对象属性有很大的帮助', '\\static\\upload\\20190722\\5348b5cf1bb3fdcd7b6f93f84ef8adcc.png', '```\r\nlet arr  = {\r\n   \'name\':\'张三\',\r\n   \'age\':12\r\n};\r\n\r\nfor(let key in arr){\r\n   console.log(key);  //name,age\r\n   console.log(arr[key]);//张三,12\r\n}\r\n```', '2', '', '1563690232', '1563806838');
INSERT INTO `blog_post` VALUES ('18', 'thinkphp5拦截器', 'url路径拦截器，用于权限判断，ajax判断等', '\\static\\upload\\20190723\\1703c15a4117f99f29a3536c40b5c8c1.png', '####thinkphp5默认提供了拦截器功能，但是如果调用一个请求方式不对等的路径，则只会爆出当前路由不存在，并不会提示出错误信息。这里我自定了一个拦截器\r\n```\r\nclass BaseController extends Controller\r\n{\r\n    protected $methods = [];\r\n\r\n    protected function _initialize()\r\n    {\r\n        /*操作方法名称*/\r\n        $action = request()->action();\r\n\r\n        /**\r\n         * ajax检测\r\n         */\r\n        if (array_key_exists(\'ajax\', $this->methods)) {\r\n            if (in_array($action, $this->methods[\'ajax\'])) {\r\n                returnJson(\'请使用ajax提交\', AJAX_SUBMIT);\r\n            }\r\n        }\r\n        /**\r\n         * 管理员检测\r\n         */\r\n        if (array_key_exists(\'ajax\', $this->methods)) {\r\n            if (in_array($action, $this->methods[\'admin\'])) {\r\n                if (Session::get(\'user\') == null) {\r\n                    /*是否是ajax请求*/\r\n                    if (request()->isAjax()) {\r\n                        returnJson(\'需要管理员权限，请登录\', NO_ADMIN_AUTHORITY);\r\n                    } else {\r\n                        $this->redirect(\"/admin\");\r\n                    }\r\n                }\r\n            }\r\n        }\r\n    }\r\n}\r\n```\r\n这里我创建一个``BaseController``，其他控制器继承这个类，并覆盖``$methods``属性。\r\n```\r\nclass ClassifyController extends BaseController\r\n{\r\n    protected $methods = [\r\n        \'admin\'=>[\'save\',\'delete\']\r\n    ];\r\n\r\n    /*创建，或者修改一个分类*/\r\n    public function save()\r\n    {\r\n        $classify = new Classify();\r\n        $classify = $classify->allowField(true);\r\n\r\n        if (input(\'id\')) {\r\n            $classify->save($_POST, input(\'id\'));\r\n        } else {\r\n            $classify->data($_POST);\r\n            $classify->save();\r\n        }\r\n        $this->success(\"保存成功\", \"/admin/classify/all\");\r\n    }\r\n\r\n    /**\r\n     * 删除一个分类\r\n     */\r\n    public function delete()\r\n    {\r\n        Classify::destroy([\'id\' => input(\'id\')]);\r\n        $this->success(\"删除成功\", \'/admin/classify/all\');\r\n    }\r\n}\r\n```\r\n``$methods``数组有两个直接子key，第一个是拦截需要登录的``action``方法，第二个是拦截需要ajax请求的方法。\r\n***\r\n当子类继承父类时，父类的``protected``、``public``属性都会与子类属性绑定，子类修改，父类也会同步修改。', '6', '', '1564105231', '1564105436');

-- ----------------------------
-- Table structure for blog_user
-- ----------------------------
DROP TABLE IF EXISTS `blog_user`;
CREATE TABLE `blog_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `nickname` varchar(255) NOT NULL DEFAULT '',
  `role` varchar(255) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_user
-- ----------------------------
