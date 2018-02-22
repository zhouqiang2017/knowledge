/*
Navicat MySQL Data Transfer

Source Server         : homestead
Source Server Version : 50719
Source Host           : 127.0.0.1:33060
Source Database       : knowledge

Target Server Type    : MYSQL
Target Server Version : 50719
File Encoding         : 65001

Date: 2018-02-22 23:12:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for answers
-- ----------------------------
DROP TABLE IF EXISTS `answers`;
CREATE TABLE `answers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `question_id` int(10) unsigned NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `votes_count` int(11) NOT NULL DEFAULT '0',
  `comments_count` int(11) NOT NULL DEFAULT '0',
  `is_hidden` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'F',
  `close_comment` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'F',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `answers_user_id_index` (`user_id`),
  KEY `answers_question_id_index` (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of answers
-- ----------------------------
INSERT INTO `answers` VALUES ('1', '1', '1', '<p>喝咖啡老顾客了</p>', '-1', '0', 'F', 'F', '2018-02-13 21:55:45', '2018-02-18 22:33:10');
INSERT INTO `answers` VALUES ('2', '1', '1', '<p>给偶加考虑将来</p>', '0', '0', 'F', 'F', '2018-02-13 22:44:26', '2018-02-19 09:45:09');

-- ----------------------------
-- Table structure for comments
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentable_id` int(10) unsigned NOT NULL,
  `commentable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `level` smallint(6) NOT NULL DEFAULT '1',
  `is_hidden` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'F',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of comments
-- ----------------------------

-- ----------------------------
-- Table structure for followers
-- ----------------------------
DROP TABLE IF EXISTS `followers`;
CREATE TABLE `followers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `follower_id` int(10) unsigned NOT NULL COMMENT '发起关注者的id--粉丝id',
  `followed_id` int(10) unsigned NOT NULL COMMENT '被关注者的id--明星id',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `followers_follower_id_index` (`follower_id`),
  KEY `followers_followed_id_index` (`followed_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of followers
-- ----------------------------
INSERT INTO `followers` VALUES ('14', '1', '2', '2018-02-16 15:07:57', '2018-02-16 15:07:57');

-- ----------------------------
-- Table structure for messages
-- ----------------------------
DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_user_id` int(10) unsigned NOT NULL,
  `to_user_id` int(10) unsigned NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `has_read` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'F',
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_from_user_id_index` (`from_user_id`),
  KEY `messages_to_user_id_index` (`to_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of messages
-- ----------------------------
INSERT INTO `messages` VALUES ('1', '1', '2', 'hahahahah', 'F', null, '2018-02-19 10:59:51', '2018-02-19 10:59:51');
INSERT INTO `messages` VALUES ('2', '1', '2', '哪里来的傻逼', 'F', null, '2018-02-19 11:04:29', '2018-02-19 11:04:29');
INSERT INTO `messages` VALUES ('3', '1', '2', '哪里来的傻逼', 'F', null, '2018-02-19 11:04:29', '2018-02-19 11:04:29');
INSERT INTO `messages` VALUES ('4', '1', '2', '来了', 'F', null, '2018-02-19 11:11:33', '2018-02-19 11:11:33');
INSERT INTO `messages` VALUES ('5', '1', '2', '又来了', 'F', null, '2018-02-19 11:11:50', '2018-02-19 11:11:50');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2018_02_11_144100_create_questions_table', '1');
INSERT INTO `migrations` VALUES ('4', '2018_02_12_091841_create_topics_table', '1');
INSERT INTO `migrations` VALUES ('5', '2018_02_12_092948_create_questions_topics_table', '1');
INSERT INTO `migrations` VALUES ('6', '2018_02_13_204837_create_answers_table', '2');
INSERT INTO `migrations` VALUES ('7', '2018_02_15_142246_create_user_question_table', '3');
INSERT INTO `migrations` VALUES ('8', '2018_02_15_200925_add_api_token_to_users', '4');
INSERT INTO `migrations` VALUES ('9', '2018_02_15_215114_create_followers_table', '5');
INSERT INTO `migrations` VALUES ('10', '2018_02_16_134019_create_notifications_table', '6');
INSERT INTO `migrations` VALUES ('11', '2018_02_18_204038_create_votes_table', '7');
INSERT INTO `migrations` VALUES ('12', '2018_02_19_095136_create_messages_table', '8');
INSERT INTO `migrations` VALUES ('13', '2018_02_22_213237_create_comments_table', '9');

-- ----------------------------
-- Table structure for notifications
-- ----------------------------
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` int(10) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of notifications
-- ----------------------------
INSERT INTO `notifications` VALUES ('6e51a7a8-3bec-425b-bb09-eaf3fd11013b', 'App\\Notifications\\NewUserFollowNotification', 'App\\User', '2', '{\"name\":\"Jhoony\"}', null, '2018-02-16 15:07:57', '2018-02-16 15:07:57');
INSERT INTO `notifications` VALUES ('a21c0a4c-3938-45a5-b82b-69c934e6de07', 'App\\Notifications\\NewUserFollowNotification', 'App\\User', '2', '{\"name\":\"Jhoony\"}', null, '2018-02-16 15:05:22', '2018-02-16 15:05:22');
INSERT INTO `notifications` VALUES ('a47e134f-92c2-4d20-bb44-b96f4520d5d3', 'App\\Notifications\\NewUserFollowNotification', 'App\\User', '2', '{\"name\":\"Jhoony\"}', null, '2018-02-16 15:01:09', '2018-02-16 15:01:09');
INSERT INTO `notifications` VALUES ('ee9f41c3-024c-4449-8056-de4d8355f8c4', 'App\\Notifications\\NewUserFollowNotification', 'App\\User', '2', '{\"name\":\"Jhoony\"}', null, '2018-02-16 13:50:05', '2018-02-16 13:50:05');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for question_topic
-- ----------------------------
DROP TABLE IF EXISTS `question_topic`;
CREATE TABLE `question_topic` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` int(10) unsigned NOT NULL,
  `topic_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `question_topic_question_id_index` (`question_id`),
  KEY `question_topic_topic_id_index` (`topic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of question_topic
-- ----------------------------
INSERT INTO `question_topic` VALUES ('1', '4', '11', '2018-02-13 10:08:54', '2018-02-13 10:08:54');
INSERT INTO `question_topic` VALUES ('3', '4', '16', '2018-02-13 10:08:54', '2018-02-13 10:08:54');
INSERT INTO `question_topic` VALUES ('5', '4', '13', '2018-02-13 16:37:45', '2018-02-13 16:37:45');
INSERT INTO `question_topic` VALUES ('6', '1', '12', '2018-02-13 20:33:47', '2018-02-13 20:33:47');

-- ----------------------------
-- Table structure for questions
-- ----------------------------
DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `comments_count` int(11) NOT NULL DEFAULT '0',
  `followers_count` int(11) NOT NULL DEFAULT '1',
  `answers_count` int(11) NOT NULL DEFAULT '0',
  `close_comment` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'F',
  `is_hidden` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'F',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of questions
-- ----------------------------
INSERT INTO `questions` VALUES ('1', '是什么让你觉得「年味儿」变淡了？', '<p><span style=\"color: rgb(68, 68, 68); font-family: -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, &quot;PingFang SC&quot;, &quot;Microsoft YaHei&quot;, &quot;Source Han Sans SC&quot;, &quot;Noto Sans CJK SC&quot;, &quot;WenQuanYi Micro Hei&quot;, sans-serif; font-size: 14px;\">年味儿是什么：年夜饭的味儿，团聚的味儿，炮仗的味儿，还是「火药味儿」？ 在家可做萌新乖宝外出也能智斗群雄，一半红火一半「硝烟」，生活何处不「战场」？且行且珍惜</span>&nbsp;&nbsp;<br></p><p><br></p>', '2', '0', '1', '2', 'F', 'F', '2018-02-13 00:15:14', '2018-02-15 21:46:28');
INSERT INTO `questions` VALUES ('4', '在 Laravel 中搭配 Async Vue Component 使用', '<p style=\"margin-top: 0px; margin-bottom: 8px; line-height: 2.2; color: rgb(82, 82, 82); font-family: &quot;Helvetica Neue&quot;, NotoSansHans-Regular, AvenirNext-Regular, arial, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, &quot;Hiragino Sans GB&quot;, &quot;WenQuanYi Micro Hei&quot;, sans-serif; font-size: 16px;\">在 Laravel 中，如果是基於要和使用者互動操作的一些介面（元件），透過撰寫 Vue Component 可以很方便地在各個 Laravel Blade 中輕鬆地透過&nbsp;<code style=\"font-family: monaco, Consolas, &quot;Liberation Mono&quot;, Menlo, Courier, monospace; font-size: 0.9em; padding: 1px 2px; color: rgb(133, 128, 128); background: rgb(249, 250, 250); border-radius: 4px; margin: 5px; border: 1px solid rgb(228, 228, 228); max-width: 740px; overflow-x: auto;\">&lt;Component /&gt;</code>&nbsp;的 tag 方式來重複使用 Vue Component。<br></p><p style=\"margin-top: 0px; margin-bottom: 8px; line-height: 2.2; color: rgb(82, 82, 82); font-family: &quot;Helvetica Neue&quot;, NotoSansHans-Regular, AvenirNext-Regular, arial, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, &quot;Hiragino Sans GB&quot;, &quot;WenQuanYi Micro Hei&quot;, sans-serif; font-size: 16px;\">目前在 Laravel 的前端打包工具大部分都是透過&nbsp;<a href=\"https://github.com/JeffreyWay/laravel-mix\" style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; color: rgb(244, 100, 95);\">laravel-mix</a>&nbsp;做整合，前陣子也才幫系統的 laravel-mix 升級到&nbsp;<strong style=\"font-weight: bold;\">2.0.0</strong>版本，基本上是無痛升級；在去年的「<a href=\"https://neighborhood999.github.io/2017/08/07/upldate-laravel-mix-from-0-x-1-x/\" style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; color: rgb(244, 100, 95);\">從 laravel-mix 0.8 升級到 1.4 版的記錄與坑</a>」這邊文章提到使用「<a href=\"https://neighborhood999.github.io/2017/08/07/upldate-laravel-mix-from-0-x-1-x/#asyncawait\" style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; color: rgb(244, 100, 95);\">async/await</a>」的方式現在也不需要安裝額外的 babel-plugin 也都可以使用了，而且現在 Laravel 內你也不需要建立&nbsp;<code style=\"font-family: monaco, Consolas, &quot;Liberation Mono&quot;, Menlo, Courier, monospace; font-size: 0.9em; padding: 1px 2px; color: rgb(133, 128, 128); background: rgb(249, 250, 250); border-radius: 4px; margin: 5px; border: 1px solid rgb(228, 228, 228); max-width: 740px; overflow-x: auto;\">.babelrc</code>&nbsp;來設定相關 babel 的設定。</p><p style=\"margin-top: 0px; margin-bottom: 8px; line-height: 2.2; color: rgb(82, 82, 82); font-family: &quot;Helvetica Neue&quot;, NotoSansHans-Regular, AvenirNext-Regular, arial, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, &quot;Hiragino Sans GB&quot;, &quot;WenQuanYi Micro Hei&quot;, sans-serif; font-size: 16px;\"><strong style=\"font-weight: bold;\">這次主要記錄是怎麼在 Laravel 中設定並使用「非同步載入 的 Vue Component」</strong>，<a href=\"https://vuejs.org/\" style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; color: rgb(244, 100, 95);\">Vue.js</a>&nbsp;官方文件在&nbsp;<a href=\"https://vuejs.org/v2/guide/components.html\" style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; color: rgb(244, 100, 95);\">Component</a>部分也有對於&nbsp;<a href=\"https://vuejs.org/v2/guide/components.html#Async-Components\" style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; color: rgb(244, 100, 95);\">Async Component</a>&nbsp;也有相關解釋，如果不太了解的話，可以參考一下。</p><p style=\"margin-top: 0px; margin-bottom: 8px; line-height: 2.2; color: rgb(82, 82, 82); font-family: &quot;Helvetica Neue&quot;, NotoSansHans-Regular, AvenirNext-Regular, arial, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, &quot;Hiragino Sans GB&quot;, &quot;WenQuanYi Micro Hei&quot;, sans-serif; font-size: 16px;\">簡單說明一下，在大型的 Application 我們可能會有許多的程式碼，但是我們希望不要一次把所有的程式碼都給打包起來，這樣會造成 bundle 的檔案過大，網頁在載入時會比較慢，而且並不是每個程式碼都會被頁面所需要，這時候我們可以拆分（chunk）程式碼成不同的 bundle 檔案（a.k.a Code Splitting），可以在需要的時候「動態」引入（Dynamic import）進來。</p><p><br></p>', '1', '0', '1', '0', 'F', 'F', '2018-02-13 10:08:54', '2018-02-13 16:37:45');

-- ----------------------------
-- Table structure for topics
-- ----------------------------
DROP TABLE IF EXISTS `topics`;
CREATE TABLE `topics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `questions_count` int(11) NOT NULL DEFAULT '0',
  `followers_count` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of topics
-- ----------------------------
INSERT INTO `topics` VALUES ('1', 'aut', 'Aut nobis quis quia eum quasi ut et. Reiciendis impedit pariatur eum facilis dicta. Magnam sapiente labore ipsa magni non doloribus.', '1', '0', '2018-02-13 09:10:12', '2018-02-13 09:10:12');
INSERT INTO `topics` VALUES ('2', 'quia', 'Rerum eligendi autem debitis doloremque eaque saepe enim non. Natus nobis veniam temporibus laborum id reprehenderit. Temporibus error et ex blanditiis esse. Illo qui libero maiores consequatur similique inventore. Minima quos et laudantium non.', '1', '0', '2018-02-13 09:10:13', '2018-02-13 09:10:13');
INSERT INTO `topics` VALUES ('3', 'eius', 'A facilis sequi saepe magni odio omnis. Animi a quis nulla ad dicta. Deserunt dicta sed aut et a unde consectetur. Ex eos sit maxime.', '1', '0', '2018-02-13 09:10:13', '2018-02-13 09:10:13');
INSERT INTO `topics` VALUES ('4', 'consequatur', 'Neque modi magnam incidunt a odio hic voluptatem. Doloribus et aut eum dolor accusantium vel quisquam.', '1', '0', '2018-02-13 09:10:13', '2018-02-13 09:10:13');
INSERT INTO `topics` VALUES ('5', 'nulla', 'Aperiam et ullam quis sunt. Temporibus distinctio in quaerat quod. Reprehenderit temporibus rem quae.', '1', '0', '2018-02-13 09:10:13', '2018-02-13 09:10:13');
INSERT INTO `topics` VALUES ('6', 'necessitatibus', 'Saepe et quasi alias animi aut. Nihil molestiae quas laboriosam qui maxime sint. Eos quaerat asperiores illo qui repudiandae. Cumque aut qui maiores voluptate et et error facere.', '1', '0', '2018-02-13 09:10:13', '2018-02-13 09:10:13');
INSERT INTO `topics` VALUES ('7', 'et', 'Sunt dolorem est accusamus laudantium. Voluptatibus sunt recusandae consequatur nostrum. Quae qui aut non enim.', '1', '0', '2018-02-13 09:10:13', '2018-02-13 09:10:13');
INSERT INTO `topics` VALUES ('8', 'error', 'Quos voluptatum amet provident sed. Voluptas rerum est voluptas. Illum fuga et ducimus voluptas minima porro eligendi. Esse voluptatem ut voluptatem. Distinctio ipsa qui exercitationem non.', '4', '0', '2018-02-13 09:10:13', '2018-02-13 09:56:07');
INSERT INTO `topics` VALUES ('9', 'voluptatem', 'Enim dolorem dolorem qui dolores quis non velit. Ut cumque inventore omnis vel. Voluptatibus omnis officia quis rerum assumenda.', '1', '0', '2018-02-13 09:10:13', '2018-02-13 09:10:13');
INSERT INTO `topics` VALUES ('10', 'saepe', 'Minus ut voluptate ducimus est officia quia unde suscipit. Iste sed omnis explicabo exercitationem. Mollitia id aut perspiciatis ipsum cumque asperiores.', '1', '0', '2018-02-13 09:10:13', '2018-02-13 09:10:13');
INSERT INTO `topics` VALUES ('11', 'Laravel', null, '10', '0', '2018-02-13 09:40:44', '2018-02-13 16:37:45');
INSERT INTO `topics` VALUES ('12', '生活', null, '2', '0', '2018-02-13 09:45:58', '2018-02-13 20:33:47');
INSERT INTO `topics` VALUES ('13', '社区', null, '3', '0', '2018-02-13 09:52:28', '2018-02-13 16:37:45');
INSERT INTO `topics` VALUES ('16', 'Vue', null, '7', '0', '2018-02-13 09:57:34', '2018-02-13 16:37:45');
INSERT INTO `topics` VALUES ('17', 'composer', null, '4', '0', '2018-02-13 16:26:02', '2018-02-13 16:31:45');

-- ----------------------------
-- Table structure for user_question
-- ----------------------------
DROP TABLE IF EXISTS `user_question`;
CREATE TABLE `user_question` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_question_user_id_index` (`user_id`),
  KEY `user_question_question_id_index` (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of user_question
-- ----------------------------
INSERT INTO `user_question` VALUES ('38', '1', '1', '2018-02-15 21:46:28', '2018-02-15 21:46:28');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `confirmation_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` smallint(6) NOT NULL DEFAULT '0',
  `questions_count` int(11) NOT NULL DEFAULT '0',
  `answers_count` int(11) NOT NULL DEFAULT '0',
  `comments_count` int(11) NOT NULL DEFAULT '0',
  `favorites_count` int(11) NOT NULL DEFAULT '0',
  `likes_count` int(11) NOT NULL DEFAULT '0',
  `followers_count` int(11) NOT NULL DEFAULT '0',
  `followings_count` int(11) NOT NULL DEFAULT '0',
  `settings` json DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `api_token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_name_unique` (`name`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_api_token_unique` (`api_token`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Jhoony', 'jqy.zhou@gmail.com', '$2y$10$FVbywFsrMiE4cD4oGvRmVOK9Pw8GQoW92nFNhckq6fFmD0Vyd2Rle', '/image/avatars/default.png', 'ECjYuubWCWeZiLvQDM8zEMRNirg6xiPnX36GgYoQ', '1', '0', '0', '0', '0', '0', '0', '0', null, 'QnRwDF3NESSXE1sl3MZikJkSSzJIm9d4i83DGzniuSKbGxUbXTYgjftF6mfv', '2018-02-13 00:03:26', '2018-02-13 00:03:26');
INSERT INTO `users` VALUES ('2', '小白', '443682811@qq.com', '$2y$10$FVbywFsrMiE4cD4oGvRmVOK9Pw8GQoW92nFNhckq6fFmD0Vyd2Rle', '/image/avatars/default.png', 'ECjYuubWCWeZiLvQDM8zEMRNirg6xiPnX36GgYoa', '1', '0', '0', '0', '0', '0', '1', '0', null, 'QnRwDF3NESSXE1sl3MZikJkSSzJIm9d4i83DGzniuSKbGxUbXTYgjftF6mfv', '2018-02-13 00:03:26', '2018-02-16 15:07:59');

-- ----------------------------
-- Table structure for votes
-- ----------------------------
DROP TABLE IF EXISTS `votes`;
CREATE TABLE `votes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `answer_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `votes_user_id_index` (`user_id`),
  KEY `votes_answer_id_index` (`answer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of votes
-- ----------------------------
INSERT INTO `votes` VALUES ('37', '1', '1', '2018-02-18 22:33:10', '2018-02-18 22:33:10');
