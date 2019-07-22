/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : blog

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-07-22 18:13:37
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_classify
-- ----------------------------
INSERT INTO `blog_classify` VALUES ('2', 'javascript', '9');
INSERT INTO `blog_classify` VALUES ('3', 'php', '3');
INSERT INTO `blog_classify` VALUES ('6', 'thinkphp5', '10');
INSERT INTO `blog_classify` VALUES ('7', 'jquery', '8');

-- ----------------------------
-- Table structure for blog_img_url
-- ----------------------------
DROP TABLE IF EXISTS `blog_img_url`;
CREATE TABLE `blog_img_url` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(1000) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_img_url
-- ----------------------------
INSERT INTO `blog_img_url` VALUES ('1', '/static/img/20190527\\b23a4b183ae26bb90dae20c8604bd97f.jpg');
INSERT INTO `blog_img_url` VALUES ('2', '/static/img/20190527\\57f5ab6bf9b1912876b1bd8c6526d948.png');
INSERT INTO `blog_img_url` VALUES ('3', '/static/img/20190610\\763831820b0762e5470e1eb0f6f18937.png');
INSERT INTO `blog_img_url` VALUES ('4', '/static/img/20190610\\8baa72c1f85ac9f24f22ea1e8a0d45ed.png');
INSERT INTO `blog_img_url` VALUES ('5', '/static/img/20190610\\cf3651496336df54bec079b16f8d34a3.png');
INSERT INTO `blog_img_url` VALUES ('6', '/static/img/20190610\\3e698e3d728bf74d571bca6dcb83c096.png');

-- ----------------------------
-- Table structure for blog_post
-- ----------------------------
DROP TABLE IF EXISTS `blog_post`;
CREATE TABLE `blog_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '',
  `intro` varchar(150) NOT NULL,
  `body` text NOT NULL,
  `classify_id` int(11) NOT NULL COMMENT '当前帖子所属分类',
  `comment_array` text NOT NULL,
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_post
-- ----------------------------
INSERT INTO `blog_post` VALUES ('3', '在javascript中嵌入php文件(技巧)', '特殊情况下的特殊方法', '>看代码\r\n```\r\n<script>\r\n/*{volist name=\'classify_list\' id=\'classify\'}*/\r\n       {value:\'{$classify.post_num}\',name:\'{$classify.name}\'},\r\n/*{/volist}*/\r\n</script>\r\n```\r\n这里为什么要将php代码注释?\r\n***\r\n* 第一、如果在javascript中加上php代码，EClint会检测出来，会报错，很不美观，而且phpstrom这种智能编辑器在敲击代码时候，会自动补全。有时候反而是反便利。\r\n* 第二、php代码在js中，无论注释与否，都会执行，该循环也会循环，极大的方便了嵌入。\r\n* 第三、只能使用``/**/``，不可使用``//``。\r\n', '6', '', '1563418146', '1563787503');
INSERT INTO `blog_post` VALUES ('4', 'tp5修改器', 'tp5修改器使用的注意事项', '```\r\nclass Classify extends Model\r\n{\r\n    protected $name = \'classify\';\r\n\r\n    //注意这里\r\n    public function getPostNumAttr($value,$data){\r\n        return count(Post::get([\'classify_id\'=>$data[\'id\']]));\r\n    }\r\n}\r\n```\r\n这里创建了数据表中没有的字段：post_num。\r\n***\r\n\r\n* 1、只能当调用User类的方法，这里才会执行。\r\n* 2、只能通过Class的对象调用post_num属性才会执行，例如：\r\n```\r\n$user = User::get(1);\r\n$post_num = $user->post_num;\r\n```\r\n***\r\n###这样是不会执行的\r\n```\r\n<script>\r\n    $list = JSON.plase(\'{$post_list|json_encode}\');\r\n    $list[0][\'post_num\'] //null\r\n</script>\r\n```\r\n修改器定义格外属性，只能通过调用属性方式获取', '6', '', '1563418191', '1563786945');
INSERT INTO `blog_post` VALUES ('5', 'jquery元素遍历器', '元素遍历器，方便对相同元素进行个体操作', '>元素遍历器 $(\"element\").each(function(index,element)=>{});\r\n```\r\n<div>\r\n   <ul>\r\n      <li>1</li>\r\n      <li>2</li>\r\n      <li>3</li>\r\n      <li>4</li>\r\n      <li>5</li>\r\n   </ul>\r\n</div>\r\n<script>\r\n    $(\'ul li\').each((index,element)=>{\r\n          $(element).html(); //1,2,3,4,5\r\n     })\r\n</script>\r\n```', '7', '', '1563496541', '1563498309');
INSERT INTO `blog_post` VALUES ('8', 'javascript对象遍历', '遍历对象，对于动态增加和删除对象属性有很大的帮助', '```\r\nlet arr  = {\r\n   \'name\':\'张三\',\r\n   \'age\':12\r\n};\r\n\r\nfor(let key in arr){\r\n   console.log(key);  //name,age\r\n   console.log(arr[key]);//张三,12\r\n}\r\n```', '2', '', '1563690232', '1563691541');

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
