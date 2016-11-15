-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-11-15 10:35:55
-- 服务器版本： 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartcms`
--

-- --------------------------------------------------------

--
-- 表的结构 `cms_admin`
--

CREATE TABLE `cms_admin` (
  `admin_id` mediumint(6) UNSIGNED NOT NULL,
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `lastloginip` varchar(15) DEFAULT '0',
  `join_time` int(10) DEFAULT '0',
  `lastlogintime` int(10) UNSIGNED DEFAULT '0',
  `email` varchar(40) DEFAULT '',
  `realname` varchar(50) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cms_admin`
--

INSERT INTO `cms_admin` (`admin_id`, `username`, `password`, `lastloginip`, `join_time`, `lastlogintime`, `email`, `realname`, `status`) VALUES
(9, 'd4smart', '66d53722e4c221d5efbe59fbb28128e8', '127.0.0.1', 1477172950, 1479121045, 'd4smart@foxmail.com', '易水人去', 1),
(10, 'Michael', '66d53722e4c221d5efbe59fbb28128e8', '127.0.0.1', 1477574413, 1478574413, '2303748137@qq.com', '陆仁贾', 1),
(13, 'json', '48c2836868eda2b0fe28c0f2aa966e21', '127.0.0.1', 1477570726, 1478870726, 'json@gmail.com', '蛤蛤！', 1),
(15, 'jane', 'f9442f606b32aced8934ce12da8e0bb3', '127.0.0.1', 1477412950, 1478912950, 'jane@163.com', '珍妮', 1),
(16, 'moha', 'f6d7ca75e7e37ce39a275e80d4f80b1e', '127.0.0.1', 1478915191, 1478915218, 'haha@jiang.com', '他', 1),
(17, 'jiang', '0eb6f73afc6aff88379bb7d0ed80691b', '127.0.0.1', 1478920865, 1478920865, 'fhf@fjf.com', 'haha ', 1),
(21, 'fsddfafaf', 'dace12499a2cb9d9335a00e2ece3f357', '127.0.0.1', 1478921811, 1478921847, 'fsd@ifjj.fsojdj', 'dfa', -1),
(22, 'fdkfj', '48c2836868eda2b0fe28c0f2aa966e21', '0', 1478939527, 0, 'dfsd@ffjjf.dfhjf', 'dfss', -1);

-- --------------------------------------------------------

--
-- 表的结构 `cms_menu`
--

CREATE TABLE `cms_menu` (
  `menu_id` smallint(6) UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL DEFAULT '',
  `parentid` smallint(6) NOT NULL DEFAULT '0',
  `m` varchar(20) NOT NULL DEFAULT '',
  `c` varchar(20) NOT NULL DEFAULT '',
  `f` varchar(20) NOT NULL DEFAULT '',
  `data` varchar(100) NOT NULL DEFAULT '',
  `listorder` smallint(6) UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `type` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cms_menu`
--

INSERT INTO `cms_menu` (`menu_id`, `name`, `parentid`, `m`, `c`, `f`, `data`, `listorder`, `status`, `type`) VALUES
(15, '菜单管理', 0, 'admin', 'menu', 'index', '', 5, 1, 1),
(16, '科技', 0, 'home', 'index', 'index', '', 1, 1, 0),
(17, '生活', 0, 'home', 'index', 'index', '', 0, -1, 0),
(18, '散文', 0, 'home', 'index', 'index', '', 0, -1, 0),
(19, '国内', 0, 'home', 'index', 'index', '', 5, 1, 0),
(20, '国际', 0, 'home', 'index', 'index', '', 4, 1, 0),
(21, '文章管理', 0, 'admin', 'content', 'index', '', 6, 1, 1),
(22, '推荐位管理', 0, 'admin', 'position', 'index', '', 2, 1, 1),
(23, '推荐位内容管理', 0, 'admin', 'positioncontent', 'index', '', 3, 1, 1),
(24, '基本配置', 0, 'admin', 'basic', 'index', '', 1, 1, 1),
(25, '用户管理', 0, 'admin', 'admin', 'index', '', 4, 1, 1),
(27, 'fds', 0, 'fsdf', 'fsa', 'f', '', 0, -1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `cms_news`
--

CREATE TABLE `cms_news` (
  `news_id` mediumint(8) UNSIGNED NOT NULL,
  `catid` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `title` varchar(80) NOT NULL DEFAULT '',
  `small_title` varchar(30) NOT NULL DEFAULT '',
  `title_font_color` varchar(250) DEFAULT NULL,
  `thumb` varchar(100) NOT NULL DEFAULT '',
  `keywords` char(40) NOT NULL DEFAULT '',
  `description` varchar(250) NOT NULL,
  `posids` varchar(250) NOT NULL DEFAULT '',
  `listorder` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `copyfrom` varchar(250) DEFAULT NULL,
  `username` char(20) NOT NULL,
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `count` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cms_news`
--

INSERT INTO `cms_news` (`news_id`, `catid`, `title`, `small_title`, `title_font_color`, `thumb`, `keywords`, `description`, `posids`, `listorder`, `status`, `copyfrom`, `username`, `create_time`, `update_time`, `count`) VALUES
(1, 19, '蛤？', '蛤蛤', '#ed568b', '/upload/2016/11/08/5821ae876e185.jpg', '蛤 思想江化 习习蛤蛤 膜蛤 醉吼的', '蛤', '', 0, 1, '0', 'd4smart', 1477635626, 1478927581, 71),
(2, 19, '中央深改组开会 12项改革方案新鲜出炉', '习近平报道集', '#ed568b', '/upload/2016/11/02/58194b1646998.jpg', '习近平 改革', '习近平报道集', '', 0, 1, '0', 'd4smart', 1478052669, 1478577547, 24),
(3, 20, '民调：朴槿惠支持率首次跌破10% 低至个位数', '韩总统亲信干政风波 崔顺实:与朴槿惠亲如姐妹的密友', '#5674ed', '/upload/2016/11/02/58194c0398a26.jpg', '韩国 朴槿惠 民调', '原标题：民调：朴槿惠支持率首次跌破10% 低至个位数  　　视频：韩总统亲信干政风波 崔顺实:与朴槿惠亲如姐妹的密友  来源：央视新闻', '', 0, 1, '2', 'd4smart', 1478052953, 1478567848, 6),
(4, 16, '那个备受争议与关注的AirPods耳机要2017年才能发货？', 'AirPods耳机要2017年才能发货？', '#ed568b', '/upload/2016/11/02/58194cf4ba4e4.jpg', 'AirPods 苹果 电子产品', 'AirPods耳机要2017年才能发货？', '', 0, 1, '1', 'd4smart', 1478053177, 1478603385, 6),
(5, 16, '49张大图看13寸新MacBook Pro拆解 有重大发现', '新MacBook Pro拆解', '#ed568b', '/upload/2016/11/02/58194d9856de4.jpg', '苹果 MacBook Pro 拆解', '新MacBook Pro拆解', '', 0, 1, '1', 'd4smart', 1478053434, 1478577645, 3),
(6, 19, '经略周边 联通亚欧：写在李克强访亚欧四国之际', '李克强访亚欧四国', '#ed568b', '/upload/2016/11/02/58194f4cd2c7f.jpg', '李克强 访问 亚欧四国', '李克强访亚欧四国', '', 0, 1, '1', 'd4smart', 1478053835, 1478655012, 3),
(7, 20, '美国大选三次辩论“一地鸡毛”透露了什么', '美国大选三次辩论“一地鸡毛”透露了什么', '#ed568b', '/upload/2016/11/02/581950335dba6.jpg', '美国大选 辩论', '美国大选三次辩论“一地鸡毛”透露了什么', '', 0, 1, '0', 'd4smart', 1478054036, 1478567875, 50),
(8, 19, '蛤蛤', '方法', '#000000', '/upload/2016/11/08/5821aa98e7ee8.jpg', '风格', '反腐败', '', 0, 0, '0', 'd4smart', 1478655800, 1478655800, 5),
(9, 19, '多部委出招规范“双11” 强调不得先涨价再打折', '今年“双11”可以放心地买买买吗？', '#ed568b', '/upload/2016/11/10/58245f066ab9c.jpg', '双11 淘宝 规范', '描述', '', 0, 1, '0', 'd4smart', 1478779088, 1478780589, 5),
(10, 19, 'ceshi', '测试', '#5674ed', '/upload/2016/11/12/5826a4f257666.jpg', 'too young 图样', '蛤', '', 0, 0, '0', 'd4smart', 1478916180, 1478927620, 2);

-- --------------------------------------------------------

--
-- 表的结构 `cms_news_content`
--

CREATE TABLE `cms_news_content` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `news_id` mediumint(8) UNSIGNED NOT NULL,
  `content` mediumtext NOT NULL,
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cms_news_content`
--

INSERT INTO `cms_news_content` (`id`, `news_id`, `content`, `create_time`, `update_time`) VALUES
(1, 1, '&lt;p&gt;\r\n	&lt;embed src=&quot;http://static.hdslb.com/miniloader.swf?aid=6943221&amp;page=1&quot; type=&quot;application/x-shockwave-flash&quot; width=&quot;640&quot; height=&quot;480&quot; quality=&quot;high&quot; /&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	苟利国家生死以，岂因祸福避趋之。\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;img src=&quot;/upload/2016/10/28/5812e4feccae5.png&quot; alt=&quot;&quot; /&gt; \r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	蛤蛤！\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;img src=&quot;/upload/2016/10/30/58159233b290f.jpg&quot; alt=&quot;&quot; /&gt; \r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;img src=&quot;/upload/2016/11/08/5821aa98e7ee8.jpg&quot; alt=&quot;&quot; /&gt; \r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;img src=&quot;/upload/2016/11/11/58252a88c6f2e.png&quot; alt=&quot;&quot; /&gt;\r\n&lt;/p&gt;', 1478927581, 1478927581),
(2, 2, '&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	中共中央总书记、国家主席、中央军委主席、中央全面深化改革领导小组组长习近平11月1日上午主持召开中央全面深化改革领导小组第二十九次会议并发表重要讲话。\n&lt;/p&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	他强调，要全面贯彻党的十八届六中全会精神，牢固树立政治意识、大局意识、核心意识、看齐意识，坚定不移抓好各项重大改革举措，既抓重要领域、重要任务、重要试点，又抓关键主体、关键环节、关键节点，以重点带动全局，把各项改革任务落到实处。\n&lt;/p&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	中共中央政治局常委、中央全面深化改革领导小组副组长李克强、刘云山、张高丽出席会议。\n&lt;/p&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	会议审议通过了\n&lt;/p&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	《建立以绿色生态为导向的农业补贴制度改革方案》\n&lt;/p&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	《关于进一步加强和改进中华文化走出去工作的指导意见》\n&lt;/p&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	《关于深化职称制度改革的意见》\n&lt;/p&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	《关于划定并严守生态保护红线的若干意见》\n&lt;/p&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	《关于最高人民法院增设巡回法庭的请示》\n&lt;/p&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	《关于进一步引导和鼓励高校毕业生到基层工作的意见》\n&lt;/p&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	《关于加强政务诚信建设的指导意见》\n&lt;/p&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	《关于加强个人诚信体系建设的指导意见》\n&lt;/p&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	《关于全面加强电子商务领域诚信建设的指导意见》\n&lt;/p&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	《自然资源统一确权登记办法（试行）》\n&lt;/p&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	《湿地保护修复制度方案》\n&lt;/p&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	《海岸线保护与利用管理办法》\n&lt;/p&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	《关于在深化国有企业改革中坚持党的领导加强党的建设落实情况报告》\n&lt;/p&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	&lt;strong&gt;建立以绿色生态为导向的&lt;/strong&gt;&lt;strong&gt;农业补贴制度&lt;/strong&gt;\n&lt;/p&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	会议指出，建立以绿色生态为导向的农业补贴制度，要在确保国家粮食安全和农民收入稳定增长前提下，坚持稳妥推进、渐进调整。要以现有补贴政策的改革完善为切入点，从制约农业可持续发展的重要领域和关键环节入手，突出绿色生态导向，加快推动落实相关农业补贴政策改革，强化耕地、草原、林业、湿地等主要生态系统补贴政策，探索重金属污染耕地治理、农业面源污染治理、农业高效节约用水等有效支持政策，把政策目标由数量增长为主转到数量质量生态并重上来。\n&lt;/p&gt;\n&lt;div class=&quot;img_wrapper&quot; style=&quot;text-align:center;font-family:&amp;quot;font-size:16px;&quot;&gt;\n	&lt;img src=&quot;http://n.sinaimg.cn/translate/20161101/W5mE-fxxfyez2535031.jpg&quot; alt=&quot;加强和改进中华文化走出去工作&quot; /&gt;&lt;span class=&quot;img_descr&quot; style=&quot;line-height:20px;color:#666666;font-size:14px;&quot;&gt;加强和改进中华文化走出去工作&lt;/span&gt; \n&lt;/div&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	会议强调，加强和改进中华文化走出去工作，要坚定中国特色社会主义道路自信、理论自信、制度自信、文化自信，加强顶层设计和统筹协调，创新内容形式和体制机制，拓展渠道平台，创新方法手段，增强中华文化亲和力、感染力、吸引力、竞争力，向世界阐释推介更多具有中国特色、体现中国精神、蕴藏中国智慧的优秀文化，提高国家文化软实力。\n&lt;/p&gt;\n&lt;div class=&quot;img_wrapper&quot; style=&quot;text-align:center;font-family:&amp;quot;font-size:16px;&quot;&gt;\n	&lt;img src=&quot;http://n.sinaimg.cn/translate/20161101/8NF--fxxfyev9016026.jpg&quot; alt=&quot;深化职称制度改革&quot; /&gt;&lt;span class=&quot;img_descr&quot; style=&quot;line-height:20px;color:#666666;font-size:14px;&quot;&gt;深化职称制度改革&lt;/span&gt; \n&lt;/div&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	会议指出，深化职称制度改革，要以职业分类为基础，以科学评价为核心，以促进人才开发使用为目的，健全职称制度体系，完善职称评价标准，创新职称评价机制，促进职称评价和人才培养使用相结合，改进职称管理服务方式。要突出品德、能力、业绩导向，克服“唯学历、唯资历、唯论文”倾向，科学客观公正评价专业技术人才，让专业技术人才有更多时间和精力深耕专业，让作出贡献的人才有成就感和获得感。要向基层倾斜，对在艰苦偏远地区和基层一线工作的专业技术人才、急需紧缺的特殊人才等，要有一些特殊政策。\n&lt;/p&gt;\n&lt;div class=&quot;img_wrapper&quot; style=&quot;text-align:center;font-family:&amp;quot;font-size:16px;&quot;&gt;\n	&lt;img src=&quot;http://n.sinaimg.cn/translate/20161101/HDW_-fxxfyex5759516.jpg&quot; alt=&quot;划定并严守生态保护红线&quot; /&gt;&lt;span class=&quot;img_descr&quot; style=&quot;line-height:20px;color:#666666;font-size:14px;&quot;&gt;划定并严守生态保护红线&lt;/span&gt; \n&lt;/div&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	会议强调，划定并严守生态保护红线，要按照山水林田湖系统保护的思路，实现一条红线管控重要生态空间，形成生态保护红线全国“一张图”。要统筹考虑自然生态整体性和系统性，开展科学评估，按生态功能重要性、生态环境敏感性脆弱性划定生态保护红线，并将生态保护红线作为编制空间规划的基础，明确管理责任，强化用途管制，加强生态保护和修复，加强监测监管，确保生态功能不弱化、面积不减少、性质不改变。\n&lt;/p&gt;\n&lt;div class=&quot;img_wrapper&quot; style=&quot;text-align:center;font-family:&amp;quot;font-size:16px;&quot;&gt;\n	&lt;img src=&quot;http://n.sinaimg.cn/translate/20161101/0T25-fxxfyez2535034.jpg&quot; alt=&quot;增设巡回法庭&quot; /&gt;&lt;span class=&quot;img_descr&quot; style=&quot;line-height:20px;color:#666666;font-size:14px;&quot;&gt;增设巡回法庭&lt;/span&gt; \n&lt;/div&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	会议同意最高人民法院在深圳市、沈阳市设立第一、第二巡回法庭的基础上，在重庆市、西安市、南京市、郑州市增设巡回法庭。会议强调，要注意把握好巡回法庭的定位，处理好巡回法庭同所在地、巡回区以及最高人民法院本部的关系，发挥跨行政区域审理重大行政和民商事案件的作用，更好满足群众司法需求，公正高效审理案件，提高司法公信力。\n&lt;/p&gt;\n&lt;div class=&quot;img_wrapper&quot; style=&quot;text-align:center;font-family:&amp;quot;font-size:16px;&quot;&gt;\n	&lt;img src=&quot;http://n.sinaimg.cn/news/transform/20161102/F7Ie-fxxhmcp4388187.jpg&quot; alt=&quot;引导和鼓励高校毕业生到基层工作&quot; /&gt;&lt;span class=&quot;img_descr&quot; style=&quot;line-height:20px;color:#666666;font-size:14px;&quot;&gt;引导和鼓励高校毕业生到基层工作&lt;/span&gt; \n&lt;/div&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	会议指出，高校毕业生是国家宝贵的人才资源，基层是高校毕业生成长成才的重要平台。引导和鼓励高校毕业生到基层工作，要深入实施就业优先战略和人才强国战略，进一步创新体制机制，完善政策措施，健全服务体系，畅通流动渠道，加快构建引导和鼓励高校毕业生“下得去、留得住、干得好、流得动”的长效机制。\n&lt;/p&gt;\n&lt;div class=&quot;img_wrapper&quot; style=&quot;text-align:center;font-family:&amp;quot;font-size:16px;&quot;&gt;\n	&lt;img src=&quot;http://n.sinaimg.cn/translate/20161101/W5RD-fxxfyev9016030.jpg&quot; /&gt;&lt;span class=&quot;img_descr&quot; style=&quot;line-height:20px;color:#666666;font-size:14px;&quot;&gt;&lt;/span&gt; \n&lt;/div&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	&lt;strong&gt;&lt;br /&gt;\n&lt;/strong&gt;\n&lt;/p&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	&lt;strong&gt;加强政务诚信、个人诚信体系和&lt;/strong&gt;&lt;strong&gt;电子商务领域诚信建设&lt;/strong&gt;\n&lt;/p&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	会议强调，加强政务诚信、个人诚信体系和电子商务领域诚信建设，是社会信用体系建设的重要内容。要大力弘扬诚信文化，将建立诚信记录、实施守信激励和失信惩戒措施作为诚信建设的主要方面，以重点领域、重点人群为突破口，推动建立各地区各行业个人诚信记录，强化应用，奖惩联动，使守信者受益，失信者受限。要加大对各级政府和公务员失信行为惩处力度，将危害群众利益、损害市场公平交易等政务失信行为作为治理重点，发挥政务诚信对其他社会主体诚信建设的重要表率和导向作用。要加强电子商务全流程信用建设，完善市场化评价体系，强化信用监管，营造诚实守信的电子商务发展环境。\n&lt;/p&gt;\n&lt;div class=&quot;img_wrapper&quot; style=&quot;text-align:center;font-family:&amp;quot;font-size:16px;&quot;&gt;\n	&lt;img src=&quot;http://n.sinaimg.cn/translate/20161101/YGcv-fxxfyev9016032.jpg&quot; /&gt;&lt;span class=&quot;img_descr&quot; style=&quot;line-height:20px;color:#666666;font-size:14px;&quot;&gt;&lt;/span&gt; \n&lt;/div&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	&lt;strong&gt;&lt;br /&gt;\n&lt;/strong&gt;\n&lt;/p&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	&lt;strong&gt;形成归属清晰、权责明确、&lt;/strong&gt;&lt;strong&gt;监管有效的自然资源资产产权制度&lt;/strong&gt;\n&lt;/p&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	会议指出，要坚持资源公有、物权法定和统一确权登记的原则，对水流、森林、山岭、草原、荒地、滩涂以及探明储量的矿产资源等自然资源的所有权统一进行确权登记，形成归属清晰、权责明确、监管有效的自然资源资产产权制度。要坚持试点先行，以不动产登记为基础，依照规范内容和程序进行统一登记。\n&lt;/p&gt;\n&lt;div class=&quot;img_wrapper&quot; style=&quot;text-align:center;font-family:&amp;quot;font-size:16px;&quot;&gt;\n	&lt;img src=&quot;http://n.sinaimg.cn/translate/20161101/YoNc-fxxhmcp4360387.jpg&quot; /&gt;&lt;span class=&quot;img_descr&quot; style=&quot;line-height:20px;color:#666666;font-size:14px;&quot;&gt;&lt;/span&gt; \n&lt;/div&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	&lt;strong&gt;&lt;br /&gt;\n&lt;/strong&gt;\n&lt;/p&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	&lt;strong&gt;建立湿地保护修复制度&lt;/strong&gt;&lt;strong&gt;加强海岸线保护与利用&lt;/strong&gt;\n&lt;/p&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	会议强调，建立湿地保护修复制度，加强海岸线保护与利用，事关国家生态安全。要实行湿地面积总量管理，严格湿地用途监管，推进退化湿地修复，增强湿地生态功能，维护湿地生物多样性。要加强海岸线分类保护，严格保护自然岸线，整治修复受损岸线，加强节约利用，实现经济效益、社会效益与生态效益相统一。\n&lt;/p&gt;\n&lt;div class=&quot;img_wrapper&quot; style=&quot;text-align:center;font-family:&amp;quot;font-size:16px;&quot;&gt;\n	&lt;img src=&quot;http://n.sinaimg.cn/translate/20161101/xotP-fxxfyez2535036.jpg&quot; /&gt;&lt;span class=&quot;img_descr&quot; style=&quot;line-height:20px;color:#666666;font-size:14px;&quot;&gt;&lt;/span&gt; \n&lt;/div&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	&lt;strong&gt;&lt;br /&gt;\n&lt;/strong&gt;\n&lt;/p&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	&lt;strong&gt;狠抓改革落实&lt;/strong&gt; \n&lt;/p&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	会议听取了《关于在深化国有企业改革中坚持党的领导加强党的建设落实情况报告》，指出要抓实重点任务，突破薄弱环节，针对党建工作突出问题，拿出任务书、时间表、路线图，着力抓好组织、队伍、制度建设。国有企业党委（党组）要履行主体责任，推动管党治党责任落到实处。有关部门要加大改革督察工作力度，跟踪问效，推动落实。\n&lt;/p&gt;\n&lt;div class=&quot;img_wrapper&quot; style=&quot;text-align:center;font-family:&amp;quot;font-size:16px;&quot;&gt;\n	&lt;img src=&quot;http://n.sinaimg.cn/translate/20161101/-ULl-fxxhmcp4360391.jpg&quot; /&gt;&lt;span class=&quot;img_descr&quot; style=&quot;line-height:20px;color:#666666;font-size:14px;&quot;&gt;&lt;/span&gt; \n&lt;/div&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	会议强调，面对改革的复杂形势和繁重任务，要牵住改革“牛鼻子”，既抓重要领域、重要任务、重要试点，又抓关键主体、关键环节、关键节点。\n&lt;/p&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	关系全局的改革，特别是涉及重大制度创新的改革，要统一行动，任何时候不能放松、不能滞后。具体到各个领域各个方面，要坚持问题导向，哪里矛盾和问题最突出，哪个疙瘩最难解，就重点抓哪项改革。\n&lt;/p&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	要注意区分改革举措的性质类型，分类施策、精准施策。要明晰解题思路，明确责任主体、明确关键环节、明确时间节点。\n&lt;/p&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	对打基础、谋长远的制度性改革，要重点搞好制度设计，抓紧细化落实；\n&lt;/p&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	对切口小、见效快的具体改革，要盯紧抓牢，逐条跟踪，一一落实；\n&lt;/p&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	对面上提出原则性要求、鼓励引导性的改革举措，要注重社会面引导，形成合理改革预期；\n&lt;/p&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	对探路性质的改革试点，要大胆探索，及时总结经验，注意发现问题，该完善的要完善，可复制推广的要及时推广。\n&lt;/p&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	对一些矛盾和问题多、攻坚难度大的改革，各地区各部门主要负责同志要亲自挂帅，顾全大局，握指成拳，合力攻坚。\n&lt;/p&gt;\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\n	中央全面深化改革领导小组成员出席，中央和国家机关有关部门负责同志列席会议。\n&lt;/p&gt;\n&lt;div class=&quot;img_wrapper&quot; style=&quot;text-align:center;font-family:&amp;quot;font-size:16px;&quot;&gt;\n	&lt;img src=&quot;http://n.sinaimg.cn/translate/20161101/jjmP-fxxfyex5759519.jpg&quot; /&gt; \n&lt;/div&gt;\n&lt;div&gt;\n	&lt;br /&gt;\n&lt;/div&gt;', 1478052670, 1478577547),
(3, 3, '&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\r\n	中新网11月1日电 据韩联社报道，随着“亲信干政门”持续发酵，韩国总统朴槿惠的支持率直线下滑。韩国媒体与民调机构1日公布的调查结果显示，朴槿惠的支持率从10月的34.2%跌至9.2%，这是朴槿惠自就任以来支持率首次跌破10%。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\r\n	在韩国历任总统中，金泳三曾在执政第五年支持率跌至6%(盖洛普韩国数据)。金泳三在任时韩国遭遇外汇危机。中新社记者 吴旭 摄&quot;&amp;nbsp;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\r\n	&lt;img src=&quot;http://image1.chinanews.com.cn/cnsupload/big/2016/10-31/4-426/23136a75fd774e7bb45b3e4b57d28e3e.jpg&quot; alt=&quot;&quot; /&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\r\n	10月29日晚，近两万名韩国民众及民间团体人士在首尔市中心举行烛光集会，谴责“亲信干政事件”给韩国社会带来的不良影响，要求总统朴槿惠对此事负责。图为集会现场。中新社记者 吴旭 摄&quot; /&amp;gt;10月29日晚，近两万名韩国民众及民间团体人士在首尔市中心举行烛光集会，谴责“亲信干政事件”给韩国社会带来的不良影响，要求总统朴槿惠对此事负责。图为集会现场。中新社记者 吴旭 摄\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\r\n	此次调查于10月31日针对1000名成年人进行。结果显示，50-59岁和60岁以上受访者对朴槿惠的支持率大幅下降。甚至朴槿惠的政治故乡大邱和庆尚北道支持率仅8.8%，低于平均值。67.3%的受访者表示“同意朴槿惠下台”，80.9%的受访者表示“即使改组青瓦台秘书团队也不能收拾局势”。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\r\n	另外，在另一份民调中，对应如何处理当前“亲信干政门”事态的提问，有36.1%表示朴槿惠应主动引咎下台，12.1%的受访者表示朝野应弹劾朴槿惠。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\r\n	青瓦台相关人士对这些民调结果表示无可奈何，称支持率跌至一位数是迟早的事情。当天朴槿惠出席驻韩大使递交国书仪式之外，没有安排其他日程。\r\n&lt;/p&gt;', 1478052953, 1478567848),
(4, 4, '&lt;p style=&quot;font-size:14px;font-family:&amp;quot;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;img src=&quot;/upload/2016/11/08/5821b260affa4.jpg&quot; alt=&quot;&quot; width=&quot;325&quot; height=&quot;600&quot; title=&quot;&quot; align=&quot;&quot; /&gt; \r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:14px;font-family:&amp;quot;background-color:#FFFFFF;&quot;&gt;\r\n	新浪手机讯 11月2日上午消息，一些产业链相关人士称，苹果公司最新的AirPods无线耳机已经推迟发货到了明年，预计是2017年1月，这比原本预料的2016年10月要晚了很多。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:14px;font-family:&amp;quot;background-color:#FFFFFF;&quot;&gt;\r\n	分析师们普遍认为，AirPods的代工厂商英业达将在明年因为这款设备的发售出现利润增长，他们的营收预计将在2017年增长7个百分点，达到238.3亿美元，而其每股收益预计将增长35%。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:14px;font-family:&amp;quot;background-color:#FFFFFF;&quot;&gt;\r\n	对用户来说，这不是好事，这款耳机虽然在推出时候饱受争议，但期待值也很高，不少用户在等待。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:14px;font-family:&amp;quot;background-color:#FFFFFF;&quot;&gt;\r\n	AirPods是今年9月份与iPhone 7一同发布的无线耳机，它被设计成双耳分离蓝牙连接的样子，并有一个充电盒。在&lt;a href=&quot;http://tech.sina.com.cn/2016-09-13/doc-ifxvukhx5048955.shtml&quot; target=&quot;_blank&quot;&gt;评测iPhone 7的时候&lt;/a&gt;，我们曾经谈到，这款耳机是iPhone 7发布会上的一个意外惊喜。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:14px;font-family:&amp;quot;background-color:#FFFFFF;&quot;&gt;\r\n	上周，苹果公司确认了AirPods降延迟发货的事实，但并未确定时间。相关人士称：“市场对AirPods的反应令人难以置信。不过我们无法在还未准备好的情况下将产品销售。消费者只需再多等待一点时间。”\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:14px;font-family:&amp;quot;background-color:#FFFFFF;&quot;&gt;\r\n	但“一点时间”具体是多长时间，苹果公司并没说明。（晓光）\r\n&lt;/p&gt;', 1478053177, 1478603385),
(5, 5, '&lt;div id=&quot;J_Article_Player&quot;&gt;\r\n	&lt;embed type=&quot;application/x-shockwave-flash&quot; src=&quot;http://p.you.video.sina.com.cn/swf/opPlayer20160913_V5_1_1_43.swf&quot; width=&quot;525&quot; height=&quot;430&quot; id=&quot;myMovie&quot; allowscriptaccess=&quot;always&quot; quality=&quot;high&quot; /&gt;\r\n&lt;/div&gt;\r\n&lt;p style=&quot;font-size:14px;font-family:&amp;quot;background-color:#FFFFFF;&quot;&gt;\r\n	新浪数码讯 11月2日消息，粉丝正在等待苹果MacBook Pro的升级。上周，苹果发布了两款新MacBook Pro，其中一款配有Touch Bar触控条，另一款则搭载传统的功能键。通过ifixit的拆解发现，全新MacBook Pro配备了可以更换的SSD固态硬盘，这意味着用户可以自行升级SSD。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:14px;font-family:&amp;quot;background-color:#FFFFFF;&quot;&gt;\r\n	这款MacBook Pro搭载了搭配了苹果订制的控制器(我们最初在2015年款MacBook中看到了这一元件，但出现在可拆卸固态硬盘上还是第一次)。这一固态硬盘采用了新的尺寸，以及新的引脚配置。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:14px;font-family:&amp;quot;background-color:#FFFFFF;&quot;&gt;\r\n	机械部分位于喇叭螺丝处新的橡胶缓冲片带来了减震效果，避免在音量最大情况下的震动。或许，最新款MacBook Pro的喇叭带来了iMac级别的技术。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:14px;font-family:&amp;quot;background-color:#FFFFFF;&quot;&gt;\r\n	如果你在苹果发布会上看到了耳机接口，那么我们也对此感到惊讶。不过，苹果继续提供耳机接口的时间可能不会太长。这一接口已经模块化(集成了两个麦克风)，位于风扇的上方。这可以很容易被替换成为Lightning或USB-C接口。最后一项功能：如果你认为，合上笔记本的过程还可以更顺滑，那么苹果此次安装了带弹簧的张力器。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:14px;font-family:&amp;quot;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;strong&gt;2016年款MacBook Pro拆解的其他细节：&lt;/strong&gt; \r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:14px;font-family:&amp;quot;background-color:#FFFFFF;&quot;&gt;\r\n	54.5瓦电池，不到去年款笔记本电池容量的75%，但超过带Touch Bar版本的49.2瓦。尽管这只是三芯电池，而不是六芯电池，但电池的安装仍非常牢固，很难拆卸。至少你要先把触控板拆下。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:14px;font-family:&amp;quot;background-color:#FFFFFF;&quot;&gt;\r\n	我们关注了苹果在媒体稿件中提到的“先进的热结构”，但并未发现什么特别先进之处。这其中包括可变间隙的风扇叶片，我们也注意到散热器安装在另一侧。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:14px;font-family:&amp;quot;background-color:#FFFFFF;&quot;&gt;\r\n	Butterfly 2.0按键得到了升级。键帽的边缘略高，因此手指击键将更准确。按键开关的重量有所增加。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:14px;font-family:&amp;quot;background-color:#FFFFFF;&quot;&gt;\r\n	不再有AirPort卡。所有WiFi和蓝牙芯片都被集成至主板，而不再需要一款单独的板卡。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:14px;font-family:&amp;quot;background-color:#FFFFFF;&quot;&gt;\r\n	不幸的是，新款MacBook Pro的易维修性得分较低，在10分中只能得到2分。(于泽 维金)\r\n&lt;/p&gt;', 1478053434, 1478577645),
(6, 6, '&lt;div id=&quot;J_Article_Player&quot;&gt;\r\n	&lt;embed type=&quot;application/x-shockwave-flash&quot; src=&quot;http://p.you.video.sina.com.cn/swf/opPlayer20160913_V5_1_1_43.swf&quot; width=&quot;525&quot; height=&quot;430&quot; id=&quot;myMovie&quot; allowscriptaccess=&quot;always&quot; quality=&quot;high&quot; /&gt;\r\n&lt;/div&gt;\r\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\r\n	深秋时节，国务院总理李克强踏上深耕周边、联通亚欧之旅。在这收获的季节，中国对亚欧外交又迎来一次重大行动。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\r\n	11月2日至9日，李克强将访问吉尔吉斯斯坦并出席上海合作组织（上合组织）成员国政府首脑（总理）理事会第十五次会议、访问哈萨克斯坦并出席中哈总理第三次定期会晤、访问拉脱维亚并出席第五次中国-中东欧国家领导人会晤、访问俄罗斯并出席中俄总理第二十一次定期会晤。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\r\n	&lt;img src=&quot;/upload/2016/11/09/58227c21e2f16.png&quot; alt=&quot;&quot; /&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\r\n	八天四国五站，李克强此行时间短、日程紧、转场多。分析人士认为，此访对引领上合组织以及中国-中东欧国家领导人会晤机制深入发展、推动共建“一带一路”和国际产能合作、维护我国家安全和利益具有重要意义。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\r\n	“ 以定期会晤为契机 增进与往访国及地区战略互信此次出访的四个国家在日程安排上有一个共性，即定期会晤机制。除了参加定期召开的上合组织成员国政府首脑（总理）理事会会议和中国-中东欧国家领导人会晤，李克强还将与哈萨克斯坦和俄罗斯总理分别举行两国总理定期会晤。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\r\n	分析人士认为，定期会晤机制在中国的总体外交战略布局中至关重要，能够保证外交政策有战略、有方案、有计划、有规矩地实施下去，不仅有利于增进与往访国和区域的战略互信，还在拓展和落实双边和多边合作方面发挥着不可替代的作用。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\r\n	从双边层面来看，中国目前已与俄罗斯、德国、波兰、澳大利亚、哈萨克斯坦等国建立了总理级定期会晤机制。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\r\n	中国社会科学院上合组织研究中心秘书长孙壮志说，总理会晤谈论的问题聚焦具体合作领域，特别是落实双边合作项目。这种会晤机制一般一年一次，对双边经贸合作尤为重要，因为高层间的定期直接对话可以及时解决经贸合作中的问题，不至于影响下一步的合作。而且这种定期会晤机制也会给其他政府部门开展对口合作提供平台，纳入很多相关的合作，特别是经济和人文领域的合作。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\r\n	孙壮志对李克强此次“定期会晤”之旅充满期待。在他看来，此次出访的四个国家外部经济环境相对比较严峻，结构调整也进入深水区，中国和这些国家的合作具有示范性、开创性和开拓性等特点。另外，这些国家都是“一带一路”沿线重要国家，彼此间的合作能够更好地支撑“一带一路”建设，为“一带一路”的顺利推进创造有利条件。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\r\n	“ 以产能合作为抓手 推动务实合作走深走实除了定期会晤，李克强此次出访的另一个重要看点就是产能合作。2014年12月李克强访问哈萨克斯坦期间，中哈两国就开展产能合作达成共识，签署了价值140亿美元的合作文件，并就180亿美元的“中哈合作框架协议”达成初步共识。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\r\n	经过两年多的发展，中国引领的国际产能合作进入早期收获期。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\r\n	“中哈产能合作的早期成果比较明显，尤其是在水泥、平板玻璃等制造业领域。这种合作模式具有很强的针对性，不仅结合了相关国家在经济转型阶段的经济利益诉求，而且面向未来，是一种富有时代气息的新经贸合作模式，”中国国际问题研究院欧亚研究所所长陈玉荣告诉记者。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\r\n	分析人士认为，中国引领的国际产能合作突出了互利共赢的合作观，不仅加强了国内企业间的合作，形成产业集群，还加强了双边、多边、第三方乃至多方企业间的产业合作，从“互利双赢”升级为“互利三赢”“互利多赢”。这无疑将扩大产能合作利益汇合点，实现合作最大公约数，形成新的更大的利益共同体。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\r\n	本次出访，产能合作依然是重中之重，预计将会签署多项合作协议，推动双边和多边务实合作走深走实。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\r\n	陈玉荣认为，中国与这四个国家合作由来已久。面对增长乏力的全球经济，中国提出与这些国家加强产能合作，实际上是一种新的经济合作方式。这种创新使处于经济转型过程中的相关国家经济能够实现持续发展，有助于各国经济深度挖潜，同时带动双边经贸合作。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\r\n	“ 以区域机制为平台 促进区域合作换挡提速中国日益重视发挥区域合作机制作用。此次李克强出席的两个区域合作机制均由中国首倡，充分显示了中国加强区域合作、维护区域和平及稳定的决心。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\r\n	在孙壮志看来，中国倡议的区域合作与西方主导的区域合作明显不同，最重要的区别便是中国倡议更符合这些国家国情。上合组织和中国-中东欧国家合作框架都是新型的区域合作倡议，框架安排基于对参与国发展水平的评估，充分考虑到各国国情，旨在实现平等互利。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\r\n	今年是上合组织成立15周年。15年来，上合组织在经贸、安全以及人文合作等领域取得丰硕成果，不仅在维护中亚地区稳定方面发挥着不可替代的作用，同时也在拉动中亚经济发展方面扮演着重要角色。与会期间，李克强将就深化上合组织框架内各领域合作、推动“一带一路”建设、推动国际产能合作和贸易投资便利化提出新倡议和新举措。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\r\n	另外，李克强此次赴拉脱维亚出席中国-中东欧国家领导人会晤也恰逢该机制“逢五”。经过几年发展，中东欧各国对该机制表现出很大兴趣，视其为加强与中国经济合作、实现经济结构互补的重要平台，一些国家已经在参与过程中尝到了甜头。此次出访期间，李克强不仅将就该机制发展提出新合作倡议，还将与中东欧各国领导人就促进和引导中国-中东欧国家合作达成共识，推动区域合作换挡提速。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\r\n	经略周边外交，引领区域合作。人们有理由相信，在进一步拉近中国与上述四国关系的同时，李克强此次亚欧之行将会为区域合作注入新的动力，进一步充实双边与多边务实合作的内涵，为亚欧地区的和平与发展奠定更加坚实的基础。 （新华社记者 尚军 李碧念 田栋栋）\r\n&lt;/p&gt;', 1478053835, 1478655012),
(7, 7, '&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\r\n	如果用精英和草根来划分美国社会，或多或少会让人联想到“精英政治”、产生阴谋论的感觉。不过，2016年的美国总统选举事到如今的发展态势，尤其三场大选辩论令人大跌眼镜、充斥丑闻、攻击、甚至谩骂的“一地鸡毛”，让人越发感觉到精英与草根的分裂，乃至精英与草根的对决。甚至有人认为，希拉里能否获胜是“精英政治”能否守住一个重要堡垒的标志。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\r\n	很难否认，共和党内民粹派的代表特朗普干掉了其他16个“当权派”精英。这里面包括“布什王朝”传人杰布·布什，“共和党的奥巴马”参议员马尔科·卢比奥，以及与共和党高层誓不俩立的茶党分子特德·克鲁兹。让人诧异的是，特朗普成功胜出凭借的不是传统的共和党拥趸。比如，华尔街金融大鳄和美国商会等早在他获得提名之前，就已经表达出对他的担忧，声称如何他当选美国经济或将由此走向衰退，美元将贬值，乃至对华“贸易战”一触即发，等等。再比如，知名的国际问题专家和共和党前政府官员排着队签名，反对特朗普竞选总统。共和党籍的前总统老布什甚至也公开宣布，将投票支持民主党总统候选人希拉里。对共和党人来说，这是一种怎样的悲哀？\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\r\n	初选期间，共和党“当权派”和精英的反对并没有阻止特朗普获得提名的步伐。其实原因只有一个，共和党的基础选民，那些草根已经不再信任所谓的精英和当权派。冷战结束以来，全球化的风起云涌和资本的无限制扩张，让人误以为技术进步和自由贸易将让全世界利益均沾。然而，实体经济的萎缩与产业外包让底层劳动者切实感觉到全球化不可阻挡的负面影响，金融资本的贪得无厌及其导致的金融危机迄今仍让人感到它的余威犹存。从“占领华尔街”、“停止国家机器”，到反对金钱政治的“民主之春”，在投票箱前愤怒的选民正在以他们对特朗普的支持，表达自己对美国现状的不满。\r\n&lt;/p&gt;\r\n&lt;div class=&quot;img_wrapper&quot; style=&quot;text-align:center;font-family:&amp;quot;font-size:16px;&quot;&gt;\r\n	&lt;img src=&quot;http://n.sinaimg.cn/news/transform/20161020/RKmB-fxwztrw3439783.JPG&quot; alt=&quot;特朗普来自上层，却被美国底层民众所拥戴。&quot; /&gt;&lt;span class=&quot;img_descr&quot; style=&quot;line-height:20px;color:#666666;font-size:14px;&quot;&gt;特朗普来自上层，却被美国底层民众所拥戴。&lt;/span&gt;\r\n&lt;/div&gt;\r\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\r\n	民主党内则是精英派做掉了民粹派，而这更是美国民主的悲哀。显然，在反对华尔街“金钱政治”、利益集团操控政策，以及反对倾向大企业的自贸协定上，参议员伯尔尼·桑德斯的主张与草根更为接近。一个要钱没钱、要人没人，只有一腔热血的美国“老愤青”，就在今年的民主党初选中单挑希拉里所代表的、急于维持现状的“当权派”。桑德斯所获得的大量小额网上捐款足以表明草根对他的挚爱，和对他倡导的“政治革命”的渴望。注意，在他的影响下，希拉里转向反对“跨太平洋伙伴关系协定”；同样在他的引领下，希拉里倡导提高最低工资，甚至于对富人增税。这位白发苍苍的参选人以自己的满腔热忱，衬托出希拉里作为传统政客的老谋深算。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\r\n	虽然美国政治还不至于像《纸牌屋》那么黑暗，但是民主党全国委员会不择手段打压桑德斯的手法，从抹黑宗教到人身攻击的确让人心有余悸。一些学者说，这就是美国选举中惯用的“负面选举”策略，没啥值得大惊小怪的。Give me a break！但没有人会对民主党全国代表大会上，那些桑德斯的支持者失望的神情与愤愤不平熟视无睹。桑德斯这位风暴中心的参选人，却显得格外平静，“对此我毫不奇怪”。无怪乎就在希拉里患病的消息传出之后，民调显示超过四成的民主党受访者希望由桑德斯来接替希拉里。\r\n&lt;/p&gt;\r\n&lt;div class=&quot;img_wrapper&quot; style=&quot;text-align:center;font-family:&amp;quot;font-size:16px;&quot;&gt;\r\n	&lt;img src=&quot;http://n.sinaimg.cn/news/transform/20161020/4u28-fxwztru6689505.JPG&quot; alt=&quot;希拉里与特朗普的对决，让美国社会精英与民粹的撕裂更加明显。&quot; /&gt;&lt;span class=&quot;img_descr&quot; style=&quot;line-height:20px;color:#666666;font-size:14px;&quot;&gt;希拉里与特朗普的对决，让美国社会精英与民粹的撕裂更加明显。&lt;/span&gt;\r\n&lt;/div&gt;\r\n&lt;p style=&quot;font-size:16px;font-family:&amp;quot;&quot;&gt;\r\n	事到如今，显然民粹派特朗普借“反当权派”之潮与民主党的“当权派”精英希拉里已经走上对决之路。某种程度上，双方的对决也预示着全球化的未来走向，是就此逆转重回保守与封闭，还是不畏艰险持续推进。从英国脱欧公投意外过关、欧洲民粹主义浪潮此起彼伏来看，特朗普的出现并不意外，而关键就在于美国政治当前是否已经走到从量变到质变的临界点。政治上的极化与否决政治盛行，经济上的复苏缓慢与增长疲弱，乃至警民冲突、族群矛盾上升正在分化美国社会，美国似乎处于全方位变革的前夜。如果说2008年“菜鸟政客”奥巴马的胜出凸显民众对“变革”的渴求，那么八年之后民众对“当权派”的厌恶、对“局外人”的盲目信任能否就此将特朗普送入白宫，还是那句老话，我们拭目以待。\r\n&lt;/p&gt;', 1478054036, 1478567875),
(8, 8, '房贷首付', 1478655800, 1478655800),
(9, 9, '&lt;p style=&quot;font-family:&quot; font-size:16px;background-color:#ffffff;text-indent:2em;&quot;=&quot;&quot;&gt;今年“双11”可以放心地买买买吗？近期，国家发改委、工商总局、质检总局、&lt;span class=&quot;infoMblog&quot;&gt;&lt;a class=&quot;a-tips-Article-QQ&quot; href=&quot;http://t.qq.com/weibomofcom#pref=qqcom.keyword&quot; target=&quot;_blank&quot;&gt;商务部&lt;/a&gt;&lt;/span&gt;等多部委相继出招，对今年“双11”进行全方位规范，虚假折扣、假冒伪劣、快递爆仓等乱象有望减少。\r\n	&lt;/p&gt;\r\n&lt;p align=&quot;center&quot; style=&quot;font-family:&quot; font-size:16px;background-color:#ffffff;&quot;=&quot;&quot;&gt; &lt;img alt=&quot;多部委出招规范“双11” 强调不得先涨价再打折&quot; src=&quot;http://img1.gtimg.com/news/pics/hv1/140/39/2153/140008910.jpg&quot; /&gt; \r\n&lt;/p&gt;\r\n&lt;p class=&quot;pictext&quot; align=&quot;center&quot; style=&quot;font-family:&quot; font-size:16px;background-color:#ffffff;&quot;=&quot;&quot;&gt;\r\n	资料图。中新网记者 李金磊 摄\r\n	&lt;/p&gt;\r\n&lt;p style=&quot;font-family:&quot; font-size:16px;background-color:#ffffff;text-indent:2em;&quot;=&quot;&quot;&gt; &lt;strong&gt;要求不得先涨价再打折&lt;/strong&gt; \r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-family:&quot; font-size:16px;background-color:#ffffff;text-indent:2em;&quot;=&quot;&quot;&gt;\r\n	今年“双11”即将到来，各大电商平台已经开始预售等各种促销活动。这个“双11”，消费者可以放心地买买买吗？\r\n	&lt;/p&gt;\r\n&lt;p style=&quot;font-family:&quot; font-size:16px;background-color:#ffffff;text-indent:2em;&quot;=&quot;&quot;&gt;\r\n	回顾历年“双11”可以发现，在销售额爆发式增长的同时，价格欺诈、虚假宣传、不正当竞争、销售假冒伪劣商品、发货迟缓、退换货难等问题也会集中显现。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-family:&quot; font-size:16px;background-color:#ffffff;text-indent:2em;&quot;=&quot;&quot;&gt;\r\n	其中， “先涨价后打折”是不少商家惯用的销售伎俩，而这也成为消费者反映的焦点问题。对此，监管部门明令禁止，要求不得先涨价再打折。\r\n	&lt;/p&gt;\r\n&lt;p style=&quot;font-family:&quot; font-size:16px;background-color:#ffffff;text-indent:2em;&quot;=&quot;&quot;&gt;\r\n	工商总局7日召集京东、阿里巴巴等15家电商，举行规范网络集中促销活动行政指导会，要求促销活动组织者和经营者要遵守促销活动规范，不得先涨价再打折，借机以次充好，以假充真。\r\n&lt;/p&gt;\r\n&lt;p align=&quot;center&quot; style=&quot;font-family:&quot; font-size:16px;background-color:#ffffff;&quot;=&quot;&quot;&gt; &lt;img alt=&quot;多部委出招规范“双11” 强调不得先涨价再打折&quot; src=&quot;http://img1.gtimg.com/news/pics/hv1/139/39/2153/140008909.jpg&quot; /&gt; \r\n	&lt;/p&gt;\r\n&lt;p class=&quot;pictext&quot; align=&quot;center&quot; style=&quot;font-family:&quot; font-size:16px;background-color:#ffffff;&quot;=&quot;&quot;&gt;\r\n	资料图。张悦 摄\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-family:&quot; font-size:16px;background-color:#ffffff;text-indent:2em;&quot;=&quot;&quot;&gt; &lt;strong&gt;集中打假将曝光典型案例&lt;/strong&gt; \r\n	&lt;/p&gt;\r\n&lt;p style=&quot;font-family:&quot; font-size:16px;background-color:#ffffff;text-indent:2em;&quot;=&quot;&quot;&gt;\r\n	在往年“双11”期间，一些商家以次充好，销售假冒伪劣商品，因此，假货问题也广为消费者诟病。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-family:&quot; font-size:16px;background-color:#ffffff;text-indent:2em;&quot;=&quot;&quot;&gt;\r\n	对此，工商总局要求，不得借机以次充好，以假充真。禁止以假劣商品为赠品进行促销。\r\n	&lt;/p&gt;\r\n&lt;p style=&quot;font-family:&quot; font-size:16px;background-color:#ffffff;text-indent:2em;&quot;=&quot;&quot;&gt;\r\n	质检总局近日下发通知，决定在全国开展“双11”消费品电商领域执法打假集中行动。针对主要网购平台和重点消费品，围绕群众投诉较多、价格不合理、媒体曝光的产品，开展摸排，收集线索。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-family:&quot; font-size:16px;background-color:#ffffff;text-indent:2em;&quot;=&quot;&quot;&gt;\r\n	在“双11”期间，质检总局将充分利用“大数据”、“云计算”等技术，整合电商消费品执法打假信息数据，通过报刊、广播、电视和互联网等媒体发布警示消息，引导消费者理性消费，形成抵制低质低价恶性竞争的氛围。届时，还将集中曝光典型案件，提高电商执法打假的影响力和震慑力。\r\n	&lt;/p&gt;\r\n&lt;p style=&quot;font-family:&quot; font-size:16px;background-color:#ffffff;text-indent:2em;&quot;=&quot;&quot;&gt;\r\n	对于可能出现的网上销售假冒伪劣商品问题，商务部也表示，根据今年初印发的《2016年全国打击侵犯知识产权和制售假冒伪劣商品工作要点》要求，将会同有关部门加强对网络交易平台的监管，严厉打击违法行为。还制定了执法协作和联合执法行动方案，将积极推进区域间、部门间执法协作。\r\n&lt;/p&gt;\r\n&lt;p align=&quot;center&quot; style=&quot;font-family:&quot; font-size:16px;background-color:#ffffff;&quot;=&quot;&quot;&gt; &lt;img alt=&quot;多部委出招规范“双11” 强调不得先涨价再打折&quot; src=&quot;http://img1.gtimg.com/news/pics/hv1/137/39/2153/140008907.jpg&quot; /&gt; \r\n	&lt;/p&gt;\r\n&lt;p class=&quot;pictext&quot; align=&quot;center&quot; style=&quot;font-family:&quot; font-size:16px;background-color:#ffffff;&quot;=&quot;&quot;&gt;\r\n	资料图。中新网记者 李金磊 摄\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-family:&quot; font-size:16px;background-color:#ffffff;text-indent:2em;&quot;=&quot;&quot;&gt; &lt;strong&gt;合力严惩“刷单炒信”&lt;/strong&gt; \r\n	&lt;/p&gt;\r\n&lt;p style=&quot;font-family:&quot; font-size:16px;background-color:#ffffff;text-indent:2em;&quot;=&quot;&quot;&gt;\r\n	“刷单炒信”也是消费者担忧的热点问题之一。消费者在网购时，通常会参考信用等级或用户对商户的评价，信用等级高、好评多的商家无疑会聚集更高的人气，“炒信”就是利用网络虚拟交易炒作信用，它严重扭曲了电商的信用评价机制，侵害了消费者的知情权和合法权益，成为电子商务领域的一大毒瘤。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-family:&quot; font-size:16px;background-color:#ffffff;text-indent:2em;&quot;=&quot;&quot;&gt;\r\n	为了抵制“刷单炒信”，国家发改委日前召开“双11”电商信用建设有关情况发布会，政府部门、社会各界、电商平台共同发起反“炒信”行动。阿里巴巴、腾讯、京东、58同城、滴滴出行、百度糯米、奇虎360、顺丰速运等企业代表共同签订了反“炒信”信息共享协议。\r\n	&lt;/p&gt;\r\n&lt;p style=&quot;font-family:&quot; font-size:16px;background-color:#ffffff;text-indent:2em;&quot;=&quot;&quot;&gt;\r\n	根据反“炒信”行动计划，将建立并定期共享“炒信”黑名单，涉嫌违法违规的“炒信”黑名单推送给相关部门，对“炒信”主体进行联合惩戒。惩戒措施包括屏蔽或删除现有账户、限制发布商品及服务、限制参加各类营销或促销活动、查封或删除社交媒体帐号、限制网络广告推广，等等。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-family:&quot; font-size:16px;background-color:#ffffff;text-indent:2em;&quot;=&quot;&quot;&gt;\r\n	工商总局也指出，将建立科学高效的管理规则，完善信用评价规则，消除“刷好评”“炒信用”等不法行为的运作空间。\r\n	&lt;/p&gt;\r\n&lt;p align=&quot;center&quot; style=&quot;font-family:&quot; font-size:16px;background-color:#ffffff;&quot;=&quot;&quot;&gt; &lt;img alt=&quot;多部委出招规范“双11” 强调不得先涨价再打折&quot; src=&quot;http://img1.gtimg.com/news/pics/hv1/138/39/2153/140008908.jpg&quot; /&gt; \r\n&lt;/p&gt;\r\n&lt;p class=&quot;pictext&quot; style=&quot;text-align: center; &quot; font-size:16px;background-color:#ffffff;text-align:center;&quot;=&quot;&quot;&gt;\r\n	资料图。张云 摄\r\n	&lt;/p&gt;\r\n&lt;p style=&quot;font-family:&quot; font-size:16px;background-color:#ffffff;text-indent:2em;&quot;=&quot;&quot;&gt; &lt;strong&gt;避免发货过度集中造成爆仓&lt;/strong&gt; \r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-family:&quot; font-size:16px;background-color:#ffffff;text-indent:2em;&quot;=&quot;&quot;&gt;\r\n	根据国家邮政局测算，今年“双11”(11月11号到16号)的业务量将超过10亿件，比去年同期增长35%，预计最高日处理量可能突破2.4亿件，比去年增长50%，是日常处理量的2.2倍左右。\r\n	&lt;/p&gt;\r\n&lt;p style=&quot;font-family:&quot; font-size:16px;background-color:#ffffff;text-indent:2em;&quot;=&quot;&quot;&gt;\r\n	在快递量持续增长的情况下，如何避免快递爆仓和延误？国家邮政局副局长刘君8日在做客中国政府网访谈时表示，已经建立了从国家局、省级、市局三级联动和政府、协会、企业三维互动的保障机制，协调电商企业与快递企业建立旺季“错峰发货、均衡推进”的机制，希望电商根据快递企业服务能力适度安排发货、快递企业根据自身能力合理接收来件，避免发货过度集中造成爆仓、瘫痪。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-family:&quot; font-size:16px;background-color:#ffffff;text-indent:2em;&quot;=&quot;&quot;&gt;\r\n	同时，每年“双11”也是快递投诉的高发期，比如网购中出现快递丢失、破损件赔偿等问题。对此，消费者有哪些渠道可以维权？\r\n	&lt;/p&gt;\r\n&lt;p style=&quot;font-family:&quot; font-size:16px;background-color:#ffffff;text-indent:2em;&quot;=&quot;&quot;&gt;\r\n	刘君表示，邮政和众多快递企业都通过各自的门户网站提供一些投诉渠道。从政府的监管端来讲，大家都知道12305，通过电话、互联网可以直接进行申诉。从前年开始还开通了微信申诉渠道YZ12305。如果用户对企业端问题解决的不满意或者想继续申诉，可以找政府部门协调。&lt;span style=&quot;font-family:;&quot;&gt;&lt;/span&gt; \r\n&lt;/p&gt;', 1478779129, 1478780589),
(10, 10, '&lt;p&gt;\r\n	蛤蛤蛤蛤蛤\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	苟利国家生死以，谈笑风生又一年。\r\n&lt;/p&gt;', 1478927620, 1478927620);

-- --------------------------------------------------------

--
-- 表的结构 `cms_position`
--

CREATE TABLE `cms_position` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` char(30) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `description` char(100) DEFAULT NULL,
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cms_position`
--

INSERT INTO `cms_position` (`id`, `name`, `status`, `description`, `create_time`, `update_time`) VALUES
(1, '首页大图', 1, '首页的大图', 1478056507, 1478830047),
(2, '小图推荐', 1, '大图右边的小图', 1478056507, 1478830106),
(3, '右侧广告位', 1, '右侧的广告位', 1478056507, 1478661558),
(4, '其他广告们', 1, '不太重要的广告', 1478660724, 1478661439);

-- --------------------------------------------------------

--
-- 表的结构 `cms_position_content`
--

CREATE TABLE `cms_position_content` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `position_id` int(5) UNSIGNED NOT NULL,
  `title` varchar(30) NOT NULL DEFAULT '',
  `thumb` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(100) DEFAULT NULL,
  `news_id` mediumint(8) UNSIGNED NOT NULL,
  `listorder` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cms_position_content`
--

INSERT INTO `cms_position_content` (`id`, `position_id`, `title`, `thumb`, `url`, `news_id`, `listorder`, `status`, `create_time`, `update_time`) VALUES
(1, 1, '蛤蛤？', '/upload/2016/11/08/5821ae876e185.jpg', '', 1, 3, 1, 1477635626, 1478828997),
(3, 1, '华中科技大学', '/upload/2016/11/08/5821b16a04842.jpg', 'www.hust.edu.cn', 0, 2, 1, 1477964584, 1478603123),
(8, 2, '蛤蛤', '/upload/2016/11/02/581957b6046b0.jpg', '', 1, 0, 1, 1477965426, 0),
(9, 2, '那个备受争议与关注的AirPods耳机要2017年才能发货？', '/upload/2016/11/02/58194cf4ba4e4.jpg', NULL, 4, 2, 1, 1478053177, 0),
(10, 2, '49张大图看13寸新MacBook Pro拆解 有重大发现', '/upload/2016/11/02/58194d9856de4.jpg', NULL, 5, 1, 1, 1478053434, 0),
(11, 1, '美国大选三次辩论“一地鸡毛”透露了什么？', '/upload/2016/11/02/581950335dba6.jpg', '', 7, 4, 1, 1478054036, 1478420710),
(12, 3, '教你如何科学优雅的装逼', '/upload/2016/11/02/58196cb417af3.jpg', 'https://www.python.org/', 0, 0, 1, 1478061317, 0),
(13, 3, 'Java从入门到一生黑', '/upload/2016/11/02/58196d3803f52.jpg', 'http://open.163.com/', 0, 0, 1, 1478061376, 0),
(14, 3, '长夜漫漫，何不高歌一曲？', '/upload/2016/11/02/581978ce42ee4.jpg', 'http://hub.hust.edu.cn/index.jsp', 0, 0, 1, 1478061435, 0),
(15, 1, '阁中帝子今何在？', '/upload/2016/11/09/582276ea8eb5c.jpg', 'http://www.bilibili.com', 0, 0, 1, 1478653708, 1478829009),
(16, 1, '苟利国家生死以，岂因祸福避趋之？', '/upload/2016/11/11/582523faab3cb.jpg', 'https://www.python.org/', 0, 0, 0, 1478829063, 1478829088),
(17, 1, '   官方汉化', '/upload/2016/11/11/58252a4b2d39e.jpg', 'fdsf', 0, 0, -1, 1478830630, 1478830668);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cms_admin`
--
ALTER TABLE `cms_admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username_2` (`username`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `cms_menu`
--
ALTER TABLE `cms_menu`
  ADD PRIMARY KEY (`menu_id`),
  ADD KEY `listorder` (`listorder`),
  ADD KEY `parentid` (`parentid`),
  ADD KEY `module` (`m`,`c`,`f`);

--
-- Indexes for table `cms_news`
--
ALTER TABLE `cms_news`
  ADD PRIMARY KEY (`news_id`),
  ADD KEY `status` (`status`),
  ADD KEY `listorder` (`listorder`),
  ADD KEY `catid` (`catid`);

--
-- Indexes for table `cms_news_content`
--
ALTER TABLE `cms_news_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_id` (`news_id`);

--
-- Indexes for table `cms_position`
--
ALTER TABLE `cms_position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_position_content`
--
ALTER TABLE `cms_position_content`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `cms_admin`
--
ALTER TABLE `cms_admin`
  MODIFY `admin_id` mediumint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- 使用表AUTO_INCREMENT `cms_menu`
--
ALTER TABLE `cms_menu`
  MODIFY `menu_id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- 使用表AUTO_INCREMENT `cms_news`
--
ALTER TABLE `cms_news`
  MODIFY `news_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- 使用表AUTO_INCREMENT `cms_news_content`
--
ALTER TABLE `cms_news_content`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- 使用表AUTO_INCREMENT `cms_position`
--
ALTER TABLE `cms_position`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `cms_position_content`
--
ALTER TABLE `cms_position_content`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
