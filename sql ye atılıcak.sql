-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 21 Oca 2025, 13:31:33
-- Sunucu sürümü: 10.5.27-MariaDB-cll-lve
-- PHP Sürümü: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `frostsub_anime`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `animeler`
--

CREATE TABLE `animeler` (
  `id` int(11) NOT NULL,
  `ad` varchar(255) NOT NULL,
  `aciklama` text DEFAULT NULL,
  `poster_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `animes`
--

CREATE TABLE `animes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `episode_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `animes`
--

INSERT INTO `animes` (`id`, `name`, `genre`, `description`, `image_url`, `created_at`, `episode_count`) VALUES
(4, 'Po No Michi', ' Dram, Slice of Life (Yaşamdan Kesitler)', 'Po no Michi, 2023 yapimi bir Japon anime dizisidir. ', 'https://external-preview.redd.it/opening-of-pon-no-michi-pon-popopon-is-now-available-in-v0-q1clu7_YnHVoOSgGF6wMZ9IdcOgn11RdvkZYQAfQRGM.jpg?auto=webp&s=d33549c150ca2bcb2092a11c037ab623c5cc71de', '2024-10-27 19:34:22', 12),
(5, 'Hige wo Soru. Soshite Joshikousei wo Hirou. 1. Sezon', 'Bu dram ve romantizm türündeki anime, 26 yaşındaki Yoshida ile evden kaçmış bir lise öğrencisi olan Sayu\'nun beklenmedik dostluğunu anlatır. Hikaye, Yoshida\'nın iş arkadaşına açılmasından sonra reddedilmesiyle başlar. Reddedilmenin ardından, eve dönerken ', 'Hige wo Soru. Soshite Joshikousei wo Hirou.\r\n(Higehiro: After Being Rejected, I Shaved and Took in a High School Runaway)\r\n\r\nBu anime, toplumun normlarını sorgulayan ve bireysel travmaların iyileşme sürecine odaklanan bir dram ve psikolojik keşif hikayesidir. Hikaye, 26 yaşındaki Yoshida\'nın, iş arkadaşına duygularını açıkladıktan sonra reddedilmesiyle başlar. Reddedilmenin ardından sarhoş halde eve dönerken, bir sokakta evsiz kalmış genç bir lise öğrencisi olan Sayu ile karşılaşır. Ailesinden ve zor bir geçmişten kaçan Sayu’nun durumuna üzülen Yoshida, onu geçici olarak evine kabul eder.\r\n\r\nYoshida ve Sayu, aralarındaki yaş farkına ve toplumun önyargılarına rağmen, güvene dayalı bir ilişki kurarak hayatı birbirlerinden öğrenmeye başlar. Sayu, zorlu geçmişi ve travmalarıyla yüzleşirken, Yoshida da ona hayatın güvenli ve sağlıklı yollarını göstererek rehberlik eder. İkisi de farklı yaşlardan ve deneyimlerden gelseler de, dostluk, iyileşme ve hayatı yeniden kurma yolunda birbirlerine destek olurlar.\r\n\r\nAnime, izleyicilere insan ilişkilerinin karmaşıklığını, dostluğun gücünü ve travmaların üstesinden gelme sürecini etkileyici bir şekilde yansıtarak, ağır fakat içten bir anlatım sunar.\r\n\r\nTemalar:\r\n\r\nTravma, pişmanlık ve iyileşme süreci\r\nGüven ve karşılıklı destek\r\nKendini keşfetme ve hayatın anlamını bulma\r\n\r\n\r\n\r\n\r\n\r\n', 'https://i0.wp.com/nyc3.digitaloceanspaces.com/blog-media-cloud/2021/04/Higehiro-Ep-4-Img-08.png?fit=1200%2C675&ssl=1', '2024-10-28 18:48:50', 13),
(6, 'Sword Art Online  4.Sezon', 'Sword Art Online: Alicization – War of Underworld (4. Sezon)\"Sword Art Online\"ın dördüncü sezonu olan Alicization – War of Underworld, serinin şimdiye kadar ki en aksiyon dolu ve duygusal sezonlarından biri. Hikaye, Alicization hikaye arkının ikinci yar', 'Sword Art Online: Alicization – War of Underworld (4. Sezon)\r\n\r\n\"Sword Art Online\"ın dördüncü sezonu olan Alicization – War of Underworld, serinin şimdiye kadar ki en aksiyon dolu ve duygusal sezonlarından biri. Hikaye, Alicization hikaye arkının ikinci yarısı olarak başlar ve Kirito’nun Underworld’deki mücadelesine odaklanır.\r\n\r\nKirito, önceki sezonda yaşadığı olaylar nedeniyle ciddi bir şekilde yaralanmış ve bilinci kapanmış durumda. Asuna, Kirito’yu kurtarmak ve Underworld’de süren savaşı sona erdirmek için diğer arkadaşlarıyla bir araya gelir. Bu sırada Underworld\'de karanlık bir tehdit büyürken, Alice\'in de geleceği tehdit altındadır. İnsan İmparatorluğu ve Karanlık Bölge arasındaki savaş giderek şiddetlenirken, Underworld’ün kaderi Kirito ve arkadaşlarının elindedir.\r\n\r\nSezon boyunca karakterler arasında derin bağlar kurulurken, özellikle Asuna ve Kirito’nun ilişkisi gelişmeye devam eder. Diğer taraftan, insan iradesinin ve dostluğun önemi vurgulanırken izleyicilere unutulmaz sahneler sunulur. Aksiyon sahneleri, görsel efektler ve hikayenin duygusal derinliği, bu sezonu hayranlar için özel kılar.', 'https://static1.cbrimages.com/wordpress/wp-content/uploads/2024/04/sword-art-online-and-isekai-anime.jpg', '2024-10-28 19:33:43', 12),
(10, 'Saikyou no Shienshoku \"Wajutsushi\" de Aru Ore wa Sekai Saikyou Clan wo Shitagaeru ', 'Harika Macera Aksiyon Büyü İsekai', 'Hikaye, başka bir dünyaya çağrılan bir kahramanın \"Destek Sınıfı\" olarak sınıflandırılmasına rağmen benzersiz yetenek sayesinde inanılmaz derecede güçlü hale gelebilir konu alır. Kahramanımız, başlangıçta düşük değerde biçilen bir meslek olan \"Wajutsushi\" (Destek Sihirbazı) sınıfıyla karşılaşır. Ancak büyüleri ve yöntemleriyle kısa sürede\r\n\r\nHikaye boyunca, kahramanımızın kendine sadık bir klan kurar ve bu güçlü ekiple birlikte, düşmanlarına karşı zafer kazanmak için savaşır. Zekası, güçlü büyüme yeteneği ve liderlik sayesinde, dünyanın en güçlü klanı haline gelirler.\r\n\r\nEser; sıra dışı bir ana karakter, büyü sistemleri, epik savaşlar ve büyüleyici dünya inşasıyla izleyiciye veya okuyucuya sürükleyici bir deneyim sunuyor. Eğer güçlü karakter gelişimi ve fantastik özellikleri varsa, bu seri', 'https://media.fstatic.com/WTykmKI7rl-EvpEHmanvTm1LNHk=/195x289/smart/filters:format(webp)/media/movies/covers/2024/09/145446.jpg', '2024-12-08 11:54:58', 12),
(12, 'Erased ', 'Psikolojik Gerilim Dram Doğaüstü Gizem Seinen', 'Hikâye, 29 yaşında başarısız bir manga sanatçısı olan Satoru Fujinuma\'yı takip eder. Satoru\'nun \"Revival\" (Yeniden Doğuş) adı verilen bir yeteneği vardır. Bu yetenek, kötü bir olay yaşanmadan hemen önce onu birkaç dakika geçmişe götürür, böylece olayı önleme şansı elde eder.\r\n\r\nBir gün annesi bir cinayete kurban gider ve Satoru\'nun kendisi de bu cinayetle suçlanır. Ancak Revival yeteneği bu kez çok daha geriye, Satoru’nun ilkokul yıllarına kadar gider. Bu olay, onu geçmişte yaşanan bir seri çocuk kaçırma ve cinayet vakasını çözmeye yönlendirir.\r\n\r\nSatoru, bu süreçte hem çocukluğunu yeniden yaşar hem de trajik olayların önüne geçmeye çalışır. Aynı zamanda eski arkadaşlarını ve ailesini koruyarak geleceği değiştirmeye çalışır.\r\n\r\nBoku dake ga Inai Machi, derin duygusal bağları, sürükleyici gerilimi ve zekice işlenen olay örgüsüyle izleyiciler ve okuyucular arasında büyük bir etki yaratmıştır.', 'https://m.media-amazon.com/images/M/MV5BZWQ2YmI5NWMtZTY2Mi00MGUxLWFhMmEtYjVjZjMwOTNkOThjXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', '2024-12-08 15:16:42', 12),
(13, 'Wonder Egg Priority', 'Dram Psikolojik Harika Gizem Seinen', ' Hikaye, yaşanacak pek çok gizemi barındırır. Karakterlerin karşılaştıkları olayların sırları, izleyiciyi sürekli merak içinde tutar.', 'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEizAFekK03dW5O2wZ6bRurI1Y0w6sA4qn6SU0N1Fy-yJAoS4dosRyTgUJrEaooietsdDZijFJvl7kJpZ8W-MWs6dHjZ5p9uZ3RWp6f_BkV13d5hnIGA29wESmLZtfeHpXzCeDYbnDfkxChp/s1400/02.jpg', '2025-01-18 18:46:00', 12),
(14, 'Girumasu ', 'Macera Fantastik Aksiyon Sihir Drama Doğaüstü', 'Anime, \"Storytellers\" adı verilen insanların bulunduğu bir dünyada geçer. Bu insanlar, masallar ve hikayeler oluşturma yeteneğine sahiptirler. Ancak, tüm hikayeler, onların yönetemediği \"Destan\"larla tehlikeye girmektedir. Bir gün, ana karakter Koshiro ve arkadaşları, dünyanın \"hikayelerini\" değiştirme ve bunların karanlık etkilerinden kurtulma görevini üstlenirler. Bu kişiler, masalları düzelterek dünyayı kurtarmaya çalışırlar.\r\n\r\nKoshiro\'nun, diğer \"Storytellers\"lardan farkı, onun geçmişi ve kimliğiyle ilgili özel bir durumu vardır: Anılarını kaybetmiştir ve dünyayı değiştiren bu gizemli durumu anlamaya çalışırken karşılaştığı farklı masal karakterleriyle ve olaylarla etkileşime girer.', 'https://dramadex.com/uploads/poster/01-2025/TruucRRUEV.jpg', '2025-01-18 20:54:13', 12),
(15, 'Solo Leveling 2 sezon ', 'Aksiyon Macera Fantastik Doğaüstü Hareket Shounen (Genç erkekler için, ama geniş bir kitleye hitap eder)', 'Solo Leveling, bir Kore webtoon serisi olup, yazarı Chugong ve çizeri Jang Sung-rak\'tır. Anime uyarlaması 2023 yılında yayımlanmaya başlanmıştır. Seri, fantastik bir dünyada geçer, burada insanlar \"kapılar\" (dungeon) aracılığıyla canavarlarla savaşıp güçlenmektedirler. Ancak, herkesin bu güçlere sahip olamadığı bir dünyada, ana karakter Jinwoo Sung oldukça zayıf bir \"Avcı\" olarak başlar.\r\n\r\nBir gün, Jinwoo, ölümcül bir görevde hayatta kalır ve gizemli bir \"Sistem\" tarafından seçilir. Bu sistem, ona yalnızca tek başına seviyesini yükseltme ve güçlü canavarlarla başa çıkma yeteneği verir. Jinwoo, normalde zayıf bir insan olmasına rağmen, bu fırsatla hızla güçlenir ve dünya çapında güçlü bir avcıya dönüşür.\r\n\r\nHikaye, Jinwoo\'nun güçlenme yolculuğunu, karşılaştığı düşmanları ve gizemli sistemin ardındaki sırları keşfetmesini anlatır. Seri, aksiyon sahneleri, strateji ve karakter gelişimi açısından oldukça dikkat çekicidir.\r\n\r\nSolo Leveling, özellikle aksiyon, fantastik öğeler ve karakterin büyüme süreciyle öne çıkar ve geniş bir izleyici kitlesine sahiptir.', 'https://fortytwofficial.com/wp-content/uploads/2024/12/solo-leveling-2-sezon-cikis-tarihi-ve-fazlasi-0001.webp', '2025-01-18 20:58:49', 13),
(16, 'Class no Daikirai na Joshi to Kekkon suru Koto ni Natta', 'Romantik Komedi Okul Drama', 'Class no Daikirai na Joshi to Kekkon suru Koto ni Natta (I\'m Getting Married to a Girl I Hate in My Class) anime serisi, birbirinden hoşlanmayan iki sınıf arkadaşının beklenmedik bir şekilde evlilik yapmasını konu alır. Hikaye, iki gencin zıt karakterleri ve aralarındaki çekişmeler üzerinden mizah ve duygusal gelişmelerle ilerler. Zoraki bir evlilikle başlayan ilişkileri, zamanla dostluk ve aşka dönüşür. Anime, komik ve duygusal sahneleriyle izleyicilere romantik bir deneyim sunarken, gençlik sorunlarına ve ilişkilere dair içgörüler sunar.', 'https://a.storyblok.com/f/178900/750x1060/6a084e89ac/class-no-dai-kirai-kv.jpg/m/filters:quality(95)format(webp)', '2025-01-19 09:39:03', 12),
(17, 'Dandadan ', 'Aksiyon, Komedi', 'Anime, aksiyon, komedi ve doğaüstü bir araya getirilerek harmanlanarak sürükleyici bir hikaye sunuluyor. Okarun ve Momo\'nun ilişkisi, başlangıçta birbirlerine tamamen açık olan karakterlerin birlikte mücadele etmeleri ve birbirlerine güvenmemelerine konu olur. Özellikle doğaüstü varlıklar, canavarlar ve mistik olaylarla ortaya çıkan çalışan karakterler, uygulamalare eğlenceli ve heyecan dolu bir d\r\n\r\nDizi, hem aksiyon sahneleriyle hem de mizahi unsurlarla dikkat çekiyor, izleyicileri hem güldürür hem de heyecanlandırıyor. Ayrıca fantastik gelişmelerle zenginleştirilmiş, hızla bir macera sunar.', 'https://upload.wikimedia.org/wikipedia/en/thumb/7/72/Dandadan_KV.png/220px-Dandadan_KV.png', '2025-01-19 12:35:44', 12),
(18, 'Kusuriya no Hitorigoto (The Apothecary Diaries)', 'Tarihi Gerilim  Drama Romantizm Gerilim ', 'Maomao, saraya, bir saray hizmeti olarak alınır ancak o, sıradan bir hizmetkâr değil, geniş bir etkiye sahip bir apotekerdir. Saraya adım attığında, tıbbî bilgisi ve zekâsı sayesinde pek çok gizemi ayrıştırmayı bulur. Her bölümde Maomao, sarayın derinliklerine inerek, çeşitli zehir olaylarını, saray entrikalarını ve komploları teşebbüs eder. Aynı zamanda sarayda yükselmeye çalışan diğer şekillerle de çeşitli ürünler kurar.\r\n\r\nSeri, bir yandan gizemli olaylar çözerken, bir yandan da Maomao\'nun zekası ve kişisel gelişimi, karakterdeki içsel çatışmaları ve popüler sorunlar. Ayrıca saraydaki karmaşık yaklaşım ve toplumsal normlara karşı direnişin karakterinde önemli bir tema oluşur. Romantik unsurlar, drama ve gerilimle harmanlanarak daha derin bir anlatım sağlar.', 'https://blog.aprilisfansub.com/wp-content/webp-express/webp-images/uploads/2023/12/kusuriya-no-hitorigoto-part-2.png.webp', '2025-01-19 15:35:47', 12),
(19, 'Maougun Saikyou no Majutsushi wa Ningen datta', 'isekai, fantastik, aksiyon, macera ve drama türlerine ait bir anime/manga serisidir.', 'Maougun Saikyou no Majutsushi wa Ningen datta (İngilizce adıyla: The Strongest Mage with the Weakest Crest is a Human) adlı anime, fantastik bir dünyada geçen aksiyon ve macera türlerinde bir hikayeyi anlatır.\r\n\r\nKonu: Hikayede, baş karakter Alessandro adında bir genç, büyü gücüyle tanınmış ancak ona doğuştan gelen işaret (crest) zayıf olduğu için insanlar tarafından küçümsenmiştir. Ancak Alessandro, içsel gücünün sıradan bir işaretin ötesinde olduğunu fark eder. Aslında o, güçlü bir büyücü olmasına rağmen, vücut yapısı ve yetenekleri insan doğasına sahiptir. İnsan olmanın getirdiği özgürlük ve potansiyel ile, güçlü büyüler yapmak için her türlü zorluğu aşmaya çalışır. Bu süreçte, karakterin içsel mücadeleleri, dünyadaki sistemle mücadelesi ve çevresindekilerle kurduğu ilişkiler derinlemesine işlenir.\r\n\r\nTür:\r\n\r\nIsekai: Baş karakter başka bir dünyada hayatını sürdürüyor.\r\nFantastik: Büyü, mitolojik yaratıklar ve fantastik öğelerle dolu bir dünya.\r\nAksiyon: Karakterlerin sürekli olarak savaşlar, çatışmalar ve tehditlere karşı mücadele etmesi.\r\nMacera: Baş karakterin yolculuğu ve keşifleri üzerinden gelişen bir hikaye.\r\nDrama: Karakterin içsel duygusal çatışmaları, kişisel büyüme ve zorluklar.\r\nBu serideki ana tema, dışarıdan görünenin her zaman doğru olmayabileceği ve içsel gücün, görünüşteki zayıflıkların ötesinde olabileceğidir. Aynı zamanda, insan olmanın getirdiği güç, sevgi, dayanıklılık ve azim gibi değerler de derinlemesine ele alınır.', 'https://cdn.myanimelist.net/images/anime/1814/143744.jpg', '2025-01-19 16:14:12', 12),
(21, 'guai xiang shou', 'Doğaüstü  Fantastik Korku Macera Shounen', 'Guai Xiang Shou türü, doğaüstü ve fantastik unsurlarla dolu hikayeleri kapsar. Bu türdeki animelerde, mitolojik ve efsanevi yaratıklar ana temayı oluşturur. Bu yaratıklar, insanlarla ya dostane ilişkiler kurar ya da tehdit oluşturur. Genellikle doğaüstü güçlere sahip olan bu varlıklar, hikayelerin merkezinde yer alarak büyü, gizem ve macera unsurlarını zenginleştirir. Guai Xiang Shou türündeki animeler, izleyicilere hem heyecan verici hem de mistik bir dünya sunar.', 'https://cdn.myanimelist.net/images/anime/1077/143812.jpg', '2025-01-20 18:35:56', 12),
(22, 'Kuramerukagari (Filim)', 'Gizem Bilim Kurgu Gerilim', 'Kuramerukagari, gizem, bilim kurgu ve gerilim türlerini harmanlayan bir anime filmidir. Hikaye, sürekli değişen ve karmaşık bir kömür madeni kasabasında geçer. Ana karakter Kagari, kasabanın haritasını çıkarma görevi sırasında, bu yerin derinliklerinde saklı olan bir komployla yüzleşir. Film, izleyiciyi çözülmesi gereken gizemlerle dolu bir dünyaya çekerken, bilim kurgu unsurlarıyla kasabanın mekanik yapısını ve gerilim dolu sahnelerle karakterlerin yaşadığı tehlikeleri ön plana çıkarır. Kuramerukagari, sürükleyici anlatımı ve yoğun atmosferiyle dikkat çeken bir yapımdır.', 'https://images.justwatch.com/poster/313357929/s718/kurameru-kagari.jpg', '2025-01-20 18:50:45', 1),
(23, 'Xian Wang de Richang Shenghuo 4. Sezon İzle', 'Aksiyon Fantastik Okul Komedi Sihir', '\"Xian Wang de Richang Shenghuo\" (The Daily Life of the Immortal King), baş karakteri olan Wang Ling\'in sıradışı ve komik hayatını anlatan bir anime serisidir. Wang Ling, normal bir okulda eğitim gören sıradan bir öğrenci gibi görünse de, aslında olağanüstü güçlere sahip bir ölümsüzdür. Ancak bu güçleri, onu diğerlerinden farklı kılmaz; aksine, hayattan keyif alabilmek için kendisini sıradan bir insan gibi yaşamaya zorlar.\r\n\r\nAnime, aksiyon, komedi, fantastik ve sihir öğelerini bir araya getirir. Her ne kadar ana karakter olağanüstü yeteneklere sahip olsa da, hikaye genellikle eğlenceli ve absürt bir bakış açısı ile gelişir. Wang Ling’in bu büyük güçlerini gizlemeye çalışırken yaşadığı komik anlar, okul hayatındaki zorluklar ve sıradan insan gibi yaşamaya çalışmanın getirdiği karmaşa, serinin ana temasını oluşturur.\r\n\r\nÖzellikle okul ve sihirli güçlerin iç içe geçtiği bir ortamda, Wang Ling\'in çevresindeki diğer öğrencilerle olan ilişkileri, olayları daha ilginç hale getirir. Anime, bu tarz karışık durumları eğlenceli bir şekilde sunarak izleyiciyi hem güldürür hem de aksiyon dolu sahnelerle heyecanlandırır.', 'https://static.tranimeizle.co/animes/2754/large.jpeg', '2025-01-20 19:07:17', 12),
(25, 'battle angel alita', 'Bilim Kurgu  Aksiyon Dövüş  Drama Macera Post-apokaliptik: ', 'Battle Angel Alita (Japonca: Gunnm), Yukito Kishiro tarafından yazılan ve çizilen bir manga serisidir. Hikaye, bir cyborg kız olan Alita\'nın, geçmişini keşfetmeye çalıştığı ve kimliğini bulma yolunda verdiği mücadeleyi anlatır. Bir çöplükte uyanan Alita, hafızasını kaybetmiş bir şekilde, kendisini yeniden inşa eden bir doktor tarafından kurtarılır. Zamanla dövüş sanatları konusunda ustalaşan Alita, hem geçmişinin sırlarını keşfetmeye çalışırken hem de distopik bir dünyada hayatta kalmak için mücadele eder.\r\n\r\nSeri, aksiyon, dövüş sanatları, bilim kurgu ve drama unsurlarını içerir. Alita\'nın insanlık ve yapay zeka arasındaki sınırı sorgulaması, özgür irade ve kimlik arayışı temalarını işler. Manga, aynı zamanda post-apokaliptik bir dünyada geçer, bu da dünyadaki çöküş sonrası hayatta kalmaya çalışan insanların hikayesine odaklanır. Battle Angel Alita, derin karakter gelişimi ve etkileyici dövüş sahneleriyle dikkat çeker.', 'https://cdn.kobo.com/book-images/2effa532-b670-48ef-b450-5fdc96b4d988/1200/1200/False/battle-angel-alita-8.jpg', '2025-01-20 19:21:01', 2),
(26, 'Otome Game Sekai wa Mob ni Kibishii Sekai Desu ', 'fantazi  komedi isekai romantizm', 'Karaktere Karşı Sert Davranılır), bir isekai (başka bir dünyaya geçiş) türündeki anime ve manga serisidir. Hikayenin ana karakteri, sıradan bir kadın olan Azusa Aizawa, bir gün bir otome oyununa (romantik simülasyon oyunu) sıkışıp kalır. Bu tür oyunlarda genellikle ana karakterin etrafında romantik ilişki seçenekleriyle yönlendirilen bir hikaye olur ve her şey ana karakterin etrafında döner. Ancak Azusa, bu dünyada yalnızca \"mob\" (yan karakter) rolünü üstlenir. Bu, onun hikayede belirgin bir yere sahip olmaması, genellikle ikinci plana atılması ve çoğu zaman yok sayılması anlamına gelir.\r\n\r\nAna karakterin otome oyunlarına dair bilgisinin olması, dünyada karşılaştığı karakterler ve olaylar üzerinde ona bir avantaj sağlar. Azusa, bu dünyada yan karakter olarak kabul edilen bir kişi olmasına rağmen, başına gelen zorluklarla başa çıkmaya çalışır. Bu süreçte, başkaları için önemli olmayı veya en azından kendi kimliğini ve yerini keşfetmeyi hedefler.\r\n\r\nSeri, komedi, romantizm ve dramı birleştirerek izleyicilere eğlenceli bir deneyim sunar. Özellikle ana karakterin çevresindeki ana karakterlere karşı yaşadığı çatışmalar, genellikle komik ve bazen alaycı bir şekilde işlenir. Oyun dünyasında bir mob karakter olarak yaşamanın zorlukları ve bu dünyada üstlenilen rolü değiştirme çabaları, serinin ana temasını oluşturur.', 'https://i.pinimg.com/474x/61/16/d8/6116d8b783be48ff4b27d603b41974c5.jpg', '2025-01-20 19:59:04', 12);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bolumler`
--

CREATE TABLE `bolumler` (
  `id` int(11) NOT NULL,
  `anime_id` int(11) DEFAULT NULL,
  `bolum_no` int(11) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `anime_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `comments`
--

INSERT INTO `comments` (`id`, `anime_id`, `user_id`, `comment`, `created_at`) VALUES
(8, 12, 11, 'Güzele benziyor', '2025-01-18 18:32:09'),
(9, 19, 16, 'Güzel Animeye benziyor başlıyorum', '2025-01-19 17:39:25');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `episodes`
--

CREATE TABLE `episodes` (
  `id` int(11) NOT NULL,
  `anime_id` int(11) NOT NULL,
  `episode_number` int(11) NOT NULL,
  `video_url` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `episodes`
--

INSERT INTO `episodes` (`id`, `anime_id`, `episode_number`, `video_url`, `created_at`) VALUES
(21, 4, 1, 'https://drive.google.com/file/d/1gtBeY10xNibSthi7LENKMZe3V2kNGJaf/preview', '2024-10-28 10:38:22'),
(22, 4, 2, 'https://drive.google.com/file/d/1oguqZ6_Qm-wXjVpn4yZzg7lXYivanFPh/preview', '2024-10-28 10:39:11'),
(23, 4, 3, 'https://drive.google.com/file/d/1pfliCtK1WJwusbNgRPrlOnrs0affG3qg/preview', '2024-10-28 10:39:59'),
(24, 4, 4, 'https://drive.google.com/file/d/1m9uulIre0A1yzWh6U8pGYw4DcgSwbP9l/preview', '2024-10-28 10:40:55'),
(25, 4, 5, 'https://drive.google.com/file/d/1Sh8yZ--YSuqcKmm0RKcNwD4Wr4DFjCQB/preview', '2024-10-28 10:41:26'),
(26, 4, 6, 'https://drive.google.com/file/d/1Y_BHur3XLpHx1-X_WYRz7fExrA6S0Lh7/preview', '2024-10-28 10:42:35'),
(27, 4, 7, 'https://drive.google.com/file/d/1kG83qCBew5vP2Gfnhe8rKULExLA0cJg0/view?usp=sharing', '2024-10-28 10:43:13'),
(28, 4, 8, 'https://drive.google.com/file/d/1Mf8HNDG1d38w4xs6st0p4iYLntUdMhxe/preview', '2024-10-28 10:43:58'),
(29, 4, 9, 'https://drive.google.com/file/d/1iBT8touCy9_eUEqiDal2dOr4FSA67Oym/preview', '2024-10-28 10:44:27'),
(30, 4, 10, 'https://drive.google.com/file/d/1EMPL8z89uQ4C_2IXE7rK9iP1u1TXdYQS/preview', '2024-10-28 10:45:07'),
(31, 4, 11, 'https://drive.google.com/file/d/1Wnyml3fRdZkiA7HePGbaeGYuOQRJ1IMV/preview', '2024-10-28 10:45:39'),
(32, 4, 12, 'https://drive.google.com/file/d/1mjY3Qd3OHmiSaUQbXQGnyXKI8chQ20lp/preview', '2024-10-28 10:46:15'),
(33, 5, 1, 'https://drive.google.com/file/d/1WP0kb5tjKRrLvjgy1LNSXMUNxI7byTuD/preview', '2024-10-28 18:50:53'),
(34, 5, 2, 'https://drive.google.com/file/d/1Xc9yNzmCwu7y5PZtRZiF4pKRDkvlzbM5/preview', '2024-10-28 18:52:52'),
(35, 5, 3, 'https://drive.google.com/file/d/15xtH5JfyBN-EpEZqRwT2XqsubGx0-8I_/preview', '2024-10-28 18:55:00'),
(36, 5, 4, 'https://drive.google.com/file/d/1xTEdIicjDxDo3Y9_OEXYAjqUFb0slzTW/preview', '2024-10-28 18:55:27'),
(37, 5, 5, 'https://drive.google.com/file/d/19PMtq4e0C_NhRN14XjT6nPF5MjrCGwWh/preview', '2024-10-28 18:55:53'),
(38, 5, 6, 'https://drive.google.com/file/d/1etHbOZXDEZnV847qkzg3HG2ikHvtpUE7/preview', '2024-10-28 18:56:35'),
(39, 5, 7, 'https://drive.google.com/file/d/1YZRJeAA_vRnYaW2Ej0Rr4Ltb4r8TZwLt/preview', '2024-10-28 18:57:58'),
(40, 5, 8, 'https://drive.google.com/file/d/1MIAf4BZIbP5gHzYXcNaFwp9tVeR8TcDC/preview', '2024-10-28 18:59:38'),
(41, 5, 9, 'https://drive.google.com/file/d/1AM7XO0UdD73AbWqQJE1_8MB5U8TTC-Sg/preview', '2024-10-28 19:00:45'),
(42, 5, 10, 'https://drive.google.com/file/d/1aCHXHChw0ffba8ZnPcupyrMHs1mr6oEv/preview', '2024-10-28 19:02:13'),
(43, 5, 11, 'https://drive.google.com/file/d/14YuCSBzJ4rqzRZmWdpVZowRNLz_IdEPu/preview', '2024-10-28 19:02:49'),
(47, 6, 1, 'https://drive.google.com/file/d/13A58OyGkAQeuFgNfCYhMzXsgWPOzxnmC/preview', '2024-10-28 19:54:00'),
(48, 6, 2, 'https://drive.google.com/file/d/1BocV-NyOTnr3VITWFoUo4c9Qwa7pSedp/preview', '2024-10-28 19:54:28'),
(49, 6, 3, 'https://drive.google.com/file/d/1dUcXntsgQKSrhB4whz2X-9erYLQ1ZzkI/preview', '2024-10-28 19:55:05'),
(55, 5, 12, 'https://drive.google.com/file/d/1Qq1sAHBVS0256cP5wbABjthdg9nfTFH2/preview', '2024-12-07 18:14:16'),
(56, 5, 13, 'https://drive.google.com/file/d/1Y5bGiy_jI4YO5l4yDfHwhzQUeCRdccdq/preview', '2024-12-07 18:14:56'),
(58, 10, 1, 'https://drive.google.com/file/d/1CscpMctoL9j9z8GXQi7_rlOKzG92rUNb/preview', '2024-12-08 11:56:53'),
(60, 10, 2, 'https://drive.google.com/file/d/1-KqdKKEKSBJItsdBrYjKZe-3_7Q63Nia/preview', '2024-12-08 11:58:19'),
(63, 12, 2, 'https://drive.google.com/file/d/1n_i-arbIUVJcHG4JK-2yyCfWasKbOQdo/view?usp=drive_link/preview', '2024-12-08 15:18:04'),
(64, 12, 3, 'https://drive.google.com/file/d/1k51fePd8vC8VFFr3emue1_q7OPwAzOtJ/preview', '2024-12-08 15:18:32'),
(68, 12, 1, 'https://drive.google.com/file/d/1mJhDjEkvgRJyabjw6_11gj8D7yrBuud3/preview', '2024-12-08 15:24:54'),
(70, 12, 4, 'https://drive.google.com/file/d/1oi8Fbl9zEiiMY2HBARXqff85_j1H9kVA/preview', '2025-01-18 18:35:53'),
(71, 12, 5, 'https://drive.google.com/file/d/12DR1VNjBDZ0kUBiViz0U4iiqo_1NU_a9/preview', '2025-01-18 18:36:41'),
(72, 12, 6, 'https://drive.google.com/file/d/1T_QlHa4HimJyBrMDUaosTB3s55YfrKAi/preview', '2025-01-18 18:37:12'),
(73, 12, 7, 'https://drive.google.com/file/d/1tehDy8HBG1a7Jc8mTaNyWbFkixHIAGKG/preview', '2025-01-18 18:38:03'),
(74, 12, 8, 'https://drive.google.com/file/d/1oppHFkvjhGxagoyDbyY4fscCTPnBbxgA/preview', '2025-01-18 18:38:51'),
(75, 13, 1, 'https://drive.google.com/file/d/1jXsXBHbCoTamlJ9Umib5kJn-QZ1Z3yo6/preview', '2025-01-18 18:47:16'),
(76, 13, 2, 'https://drive.google.com/file/d/1KuRojffPo1dcEQuWlOXH-i4M3wRrUX8e/preview', '2025-01-18 18:47:42'),
(77, 13, 3, 'https://drive.google.com/file/d/1lfpdYwl84ZMdoKGjIjBFhIG-jgSTxg0-/preview', '2025-01-18 18:48:09'),
(78, 13, 4, 'https://drive.google.com/file/d/12ZnsYAtEdLYgUyv4beLvphtrG1FRsNay/preview', '2025-01-18 18:49:40'),
(79, 13, 5, 'https://drive.google.com/file/d/14FiLBWrWJRcjG5MvcZjgMq67HUkNQxuH/preview', '2025-01-18 18:51:18'),
(80, 13, 6, 'https://drive.google.com/file/d/1IlULtDinFgME_JmBRzHfDEAi5xCoL4gP/preview', '2025-01-18 18:52:08'),
(81, 13, 7, 'https://drive.google.com/file/d/1S-R-XLEuX3gJo6YBFsYLI0AVsRmhJr-I/preview', '2025-01-18 18:55:02'),
(82, 13, 8, 'https://drive.google.com/file/d/1s0jSa1XHkphbD488z2u4vzpIZgoBAnoi/preview', '2025-01-18 18:55:24'),
(83, 13, 9, 'https://drive.google.com/file/d/1TqsUTXQqImG-KUqw-2I2pW-Ko7wBdt3k/preview', '2025-01-18 18:56:18'),
(84, 13, 10, 'https://drive.google.com/file/d/13kzxBGkiV1HfIOSPzOnYbUZHLvYOUMhm/preview', '2025-01-18 19:40:46'),
(85, 13, 11, 'https://drive.google.com/file/d/17NiFkU4alFaD-N1Q-9Ki112NxcpNp3YC/preview', '2025-01-18 19:41:25'),
(86, 13, 12, 'https://drive.google.com/file/d/19_9w9sWguWHEdSQbo8_-MjqeM3T4b14_/preview', '2025-01-18 19:42:10'),
(87, 6, 4, 'https://drive.google.com/file/d/1sw1nFUv0vTkXq8CxmU8gkSWG8yj42KDJ/preview', '2025-01-18 19:44:40'),
(88, 10, 3, 'https://drive.google.com/file/d/1M-DmCHXCoeEHoBVjiRnJ8RXGAViVwzCG/preview', '2025-01-18 20:48:14'),
(89, 10, 4, 'https://drive.google.com/file/d/1igBEz04N5CQB5u7EGQRKs0J7hcFH-ZgT/preview', '2025-01-18 20:48:37'),
(90, 14, 1, 'https://drive.google.com/file/d/1hgxZiJ9VqwDWHEkAEIvjOIaniCrlUvNH/preview', '2025-01-18 20:55:28'),
(91, 14, 2, 'https://drive.google.com/file/d/1jRW4n7KstNnobppuX7qbd-MG3iESVAYa/preview', '2025-01-18 20:56:02'),
(92, 15, 1, 'https://drive.google.com/file/d/12Vs_DfFNyAFeqYHF_D6I_hSjcRX7OV2b/preview', '2025-01-18 21:00:42'),
(93, 15, 2, 'https://drive.google.com/file/d/1JKO-JXwahGYE09vTvW6LN02bCNuVEaYp/preview', '2025-01-18 21:01:12'),
(94, 15, 3, 'https://drive.google.com/file/d/1_Uw9qHUwL5zyRWjaVBdImorjDiYzK1Ez/preview', '2025-01-18 21:01:38'),
(95, 16, 1, 'https://drive.google.com/file/d/1NVl4AR2s8aLL_Abboojbdbkr5t6-3z-N/preview', '2025-01-19 09:39:39'),
(96, 17, 1, 'https://drive.google.com/file/d/1tAvDSEyVKhDNzqSTUbxjTvhW8FlyouXq/preview', '2025-01-19 12:37:15'),
(97, 17, 2, 'https://drive.google.com/file/d/1VAsbdHCocWeKF8uY6S6rVD5YqwI4B03L/preview', '2025-01-19 12:39:37'),
(98, 17, 3, 'https://drive.google.com/file/d/1j6x_1Fz6ppzjEZ2gNxgxf2L20OaG19rK/preview', '2025-01-19 12:39:57'),
(99, 17, 4, 'https://drive.google.com/file/d/1Ho1Xsm2cVPcy-G-JRvPOQ5yB_EF_ezBx/preview', '2025-01-19 12:40:26'),
(100, 17, 5, 'https://drive.google.com/file/d/1YUCjW_GADPY2umxTBJ_tiV5RU6XzZKV7/preview', '2025-01-19 12:40:45'),
(101, 17, 6, 'https://drive.google.com/file/d/1G9LJQglqUulNi8KnhPZA2SLZFcUOZ6l9/preview', '2025-01-19 12:43:06'),
(102, 17, 7, 'https://drive.google.com/file/d/1CpYE9w_FnDa1gXKInAAkAWwcRwvXXTzj/preview', '2025-01-19 12:43:31'),
(103, 17, 8, 'https://drive.google.com/file/d/1T_Fr2ldKpy3PQsHXrd3WcXDRZVtlMBMz/preview', '2025-01-19 12:43:53'),
(104, 17, 9, 'https://drive.google.com/file/d/1aqVhrK0RuPDsy37PNeKf1tgh3JoGfaW_/preview', '2025-01-19 12:44:14'),
(105, 17, 10, 'https://drive.google.com/file/d/1665dAVSckrL4yroJiD1OOcKMOhxb33yt/preview', '2025-01-19 12:44:38'),
(106, 17, 11, 'https://drive.google.com/file/d/1Fa5WIqHPEduIdjVy5T94L9StK5HEalG8/preview', '2025-01-19 12:45:32'),
(107, 17, 12, 'https://drive.google.com/file/d/1Ehbc68VZaFoR5KlIOHf-5IPZMPWUZE4L/preview', '2025-01-19 12:46:25'),
(108, 18, 1, 'https://drive.google.com/file/d/1DsidDqaqcqpDX1bfKC4rDHjX11HQxhmM/preview', '2025-01-19 15:38:25'),
(114, 19, 1, 'https://drive.google.com/file/d/19DfrxTrmTTycuN-LnF3EgcmVVb-fI2uh/preview', '2025-01-19 16:18:22'),
(115, 19, 2, 'https://drive.google.com/file/d/19FYbT9daqhiiS9BeI8GS914PX38Pairg/preview', '2025-01-19 16:18:41'),
(116, 19, 3, 'https://drive.google.com/file/d/19HLy7ITERr5Y0qh48fIkyNXqcvaePwZd/preview', '2025-01-19 16:18:59'),
(117, 19, 4, 'https://drive.google.com/file/d/19MupsbjVvRcxS1cMKPlLQ04pDJ_fK6zG/preview', '2025-01-19 16:19:56'),
(118, 19, 5, 'https://drive.google.com/file/d/19Ue2IZojttyWWDC2OKg1JhkaO6fTNtym/preview', '2025-01-19 16:20:45'),
(119, 19, 6, 'https://drive.google.com/file/d/19VXSU6cd0CbmgFlwQoDWNeMn3rkueF88/preview', '2025-01-19 16:21:04'),
(120, 19, 7, 'https://drive.google.com/file/d/19Vd-5crRaMt34v9LEVN8NTTr0nF1KWDg/preview', '2025-01-19 16:21:26'),
(121, 19, 8, 'https://drive.google.com/file/d/19_flQgPJCA4mBAt8jOb0labx8KVVfks3/preview', '2025-01-19 16:22:06'),
(122, 19, 9, 'https://drive.google.com/file/d/19gPkKVOETRICOGqH5', '2025-01-19 16:22:23'),
(123, 19, 10, 'https://drive.google.com/file/d/19qXHXT0ajaPPKoJxLuwaOyVvGUQ92j0k/preview', '2025-01-19 16:22:53'),
(124, 19, 11, 'https://drive.google.com/file/d/1ANylcm2zW4bt-tcQFUnWKsOfqY-13_pM/preview', '2025-01-19 16:23:13'),
(125, 19, 12, 'https://drive.google.com/file/d/1ASNJMxtCWLsRC2UoYvDi_is2WBCMpiJl/preview', '2025-01-19 16:23:33'),
(126, 21, 1, 'https://drive.google.com/file/d/1CT9LIC5gkBw50pcnIIjNcIfmWFck4viW/preview', '2025-01-20 18:37:52'),
(127, 21, 2, 'https://drive.google.com/file/d/1hpP1bVsqcoSn60RHjk5KOZinRPBBwlS3/preview', '2025-01-20 18:39:51'),
(128, 21, 3, 'https://drive.google.com/file/d/1NCR8uCwYfg7an05xiRi0kNp2pEe-mZkp/preview', '2025-01-20 18:40:31'),
(129, 21, 4, 'https://drive.google.com/file/d/1fwjkxztvGMm_-CgKn2VXarQLMNHlUrLj/preview', '2025-01-20 18:40:57'),
(130, 21, 5, 'https://drive.google.com/file/d/1iX3GQ1PC0fS3FsUBAieasipJIyarvfqm/preview', '2025-01-20 18:41:31'),
(131, 21, 6, 'https://drive.google.com/file/d/15DdicAzcMJf7Xcubxg_BN8nuDNSSazX0/preview', '2025-01-20 18:41:59'),
(132, 21, 7, 'https://drive.google.com/file/d/1e2OsWcSqsSmfwSXeerOl5nOCVAAMBLuo/preview', '2025-01-20 18:42:26'),
(133, 21, 8, 'https://drive.google.com/file/d/1XugqsVU7L2IcrD5hxbjSl1m6gXY77MNj/preview', '2025-01-20 18:42:58'),
(134, 22, 1, 'https://drive.google.com/file/d/1wR45d4MNstdbxEZhHSY4Ho_ZuCzp_Kvv/preview', '2025-01-20 18:51:43'),
(136, 16, 1, 'https://drive.google.com/file/d/1LbHwis68z4n07xJ2yeJx-NKHqUZS0lsr/preview', '2025-01-20 18:59:49'),
(137, 16, 2, 'https://drive.google.com/file/d/1NJutdf41IqRibp2K808G2OnyifarS2j-/preview', '2025-01-20 19:00:35'),
(138, 23, 1, 'https://drive.google.com/file/d/1RjXJegSphbG55-e53eyNXK73NbdPxuzX/preview', '2025-01-20 19:07:58'),
(139, 23, 2, 'https://drive.google.com/file/d/1QzFZeI_zL7CHddov4DwVrjAxppkCpzEv/preview', '2025-01-20 19:09:39'),
(140, 23, 3, 'https://drive.google.com/file/d/1D4OUmCqmjBoLL-BNK3kUREzfbY1sPLOJ/preview', '2025-01-20 19:10:08'),
(141, 23, 4, 'https://drive.google.com/file/d/119urY0Pew-yqHWQpNfr_sQoeaZCsKLEX/preview', '2025-01-20 19:10:32'),
(142, 25, 1, 'https://drive.google.com/file/d/1qlz9b0-IoRzyOvH_8AKN4qJ0_lvNC0-K/preview ', '2025-01-20 19:21:36'),
(143, 25, 2, 'https://drive.google.com/file/d/1jV5SMLlRBlqQQdRRGHz8_7V0RmRPWHhJ/preview ', '2025-01-20 19:21:59'),
(146, 26, 1, 'https://drive.google.com/file/d/1Q6OSc0HMBiCmvmwiVUQqBRBe2t_NZ8om/preview', '2025-01-20 20:03:13'),
(147, 26, 2, 'https://drive.google.com/file/d/1W20L_lgo0FHWesKMNF5OFtwbDQf47ZS_/preview ', '2025-01-20 20:05:49'),
(148, 26, 3, 'https://drive.google.com/file/d/1impvRF7jbdbyyJZ6jEuG7KwDXp8SwRme/preview', '2025-01-20 20:06:37'),
(149, 26, 4, 'https://drive.google.com/file/d/1bpxqOcEubv7gNBptXwgpJ9uBo14v8dJV/preview', '2025-01-20 20:06:53'),
(150, 26, 5, 'https://drive.google.com/file/d/1YETCOM7p-Fp7H9-AtX7RzxJz_9Z_Wa_q/preview', '2025-01-20 20:07:53'),
(151, 26, 6, 'https://drive.google.com/file/d/1CYace8pBI_xN24JFrFAeDTr7BU_t6CXR/preview', '2025-01-20 20:08:23'),
(152, 26, 7, 'https://drive.google.com/file/d/12J04UwjTMiXz456waIFVMpeorfBXM_VD/preview', '2025-01-20 20:08:40'),
(153, 26, 8, 'https://drive.google.com/file/d/1huqHXSPDM3pVVHaceRI70i222-M_vYbh/preview', '2025-01-20 20:08:58'),
(155, 26, 9, 'https://drive.google.com/file/d/1gU26tgPrNaBlyz74fdeBNnRaEkWNSRNB/preview', '2025-01-20 20:13:31'),
(156, 26, 10, 'https://drive.google.com/file/d/16Y6gBcdc92LiApLHnciB06ApRPHyP0Ag/preview ', '2025-01-20 20:14:06'),
(157, 26, 11, 'https://drive.google.com/file/d/1QqEr3suVEd5SIPKsZlNzG_glMLfMXv_f/preview ', '2025-01-20 20:14:32'),
(158, 26, 12, 'https://drive.google.com/file/d/1HvO8INl3Ode7hwTGmORkunNzn6xgrwT8/preview ', '2025-01-20 20:15:09');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `fansubs`
--

CREATE TABLE `fansubs` (
  `id` int(11) NOT NULL,
  `anime_id` int(11) NOT NULL,
  `episode_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `fansubs`
--

INSERT INTO `fansubs` (`id`, `anime_id`, `episode_id`, `name`, `created_at`) VALUES
(44, 4, 21, 'FrostSubs', '2024-10-28 10:38:27'),
(45, 4, 22, 'FrostSubs', '2024-10-28 10:39:15'),
(46, 4, 23, 'FrostSubs', '2024-10-28 10:40:10'),
(47, 4, 24, 'FrostSubs', '2024-10-28 10:41:01'),
(48, 4, 25, 'FrostSubs', '2024-10-28 10:41:38'),
(49, 4, 26, 'FrostSubs', '2024-10-28 10:42:39'),
(50, 4, 27, 'FrostSubs', '2024-10-28 10:43:17'),
(51, 4, 28, 'FrostSubs', '2024-10-28 10:44:01'),
(52, 4, 29, 'FrostSubs', '2024-10-28 10:44:33'),
(53, 4, 30, 'FrostSubs', '2024-10-28 10:45:11'),
(54, 4, 31, 'FrostSubs', '2024-10-28 10:45:44'),
(55, 4, 32, 'FrostSubs', '2024-10-28 10:46:18'),
(56, 5, 33, 'Roseandnightsubs', '2024-10-28 18:51:15'),
(57, 5, 34, 'Roseandnightsubs', '2024-10-28 18:53:01'),
(58, 5, 35, 'Roseandnightsubs', '2024-10-28 18:55:04'),
(59, 5, 36, 'Roseandnightsubs', '2024-10-28 18:55:31'),
(60, 5, 37, 'Roseandnightsubs', '2024-10-28 18:55:57'),
(61, 5, 38, 'Roseandnightsubs', '2024-10-28 18:56:39'),
(62, 5, 39, 'Roseandnightsubs', '2024-10-28 18:58:02'),
(63, 5, 40, 'Rose&Night', '2024-10-28 18:59:50'),
(64, 5, 41, 'Rose&Night', '2024-10-28 19:00:51'),
(65, 5, 42, 'Rose&Night', '2024-10-28 19:02:18'),
(66, 5, 43, 'Rose&Night', '2024-10-28 19:02:54'),
(70, 6, 47, 'Rose&Night', '2024-10-28 19:54:03'),
(71, 6, 48, 'Rose&Night', '2024-10-28 19:54:34'),
(72, 6, 49, 'Rose&Night', '2024-10-28 19:55:10'),
(78, 5, 55, 'Rose&Night', '2024-12-07 18:14:23'),
(79, 5, 56, 'Rose&Night', '2024-12-07 18:15:00'),
(81, 10, 58, 'RaionSubs', '2024-12-08 11:56:59'),
(83, 10, 60, 'RaionSubs', '2024-12-08 11:58:26'),
(86, 12, 63, 'Rose&Night', '2024-12-08 15:18:07'),
(87, 12, 64, 'Rose&Night', '2024-12-08 15:18:35'),
(92, 12, 68, 'Rose&Night', '2024-12-08 15:24:59'),
(94, 12, 70, 'Rose&Night', '2025-01-18 18:36:02'),
(95, 12, 71, 'Rose&Night', '2025-01-18 18:36:45'),
(96, 12, 72, 'Rose&Night', '2025-01-18 18:37:16'),
(97, 12, 73, 'Rose&Night', '2025-01-18 18:38:06'),
(98, 12, 74, 'Rose&Night', '2025-01-18 18:38:55'),
(99, 13, 75, 'Rose&Night', '2025-01-18 18:47:19'),
(100, 13, 76, 'Rose&Night', '2025-01-18 18:47:46'),
(101, 13, 77, 'Rose&Night', '2025-01-18 18:48:12'),
(102, 13, 78, 'Rose&Night', '2025-01-18 18:49:44'),
(103, 13, 79, 'Rose&Night', '2025-01-18 18:51:21'),
(104, 13, 80, 'Rose&Night', '2025-01-18 18:52:11'),
(105, 13, 81, 'Rose&Night', '2025-01-18 18:55:05'),
(106, 13, 82, 'Rose&Night', '2025-01-18 18:55:28'),
(107, 13, 83, 'Rose&Night', '2025-01-18 18:56:21'),
(108, 13, 84, 'Rose&Night', '2025-01-18 19:40:49'),
(109, 13, 85, 'Rose&Night', '2025-01-18 19:41:32'),
(110, 13, 86, 'Rose&Night', '2025-01-18 19:42:14'),
(111, 6, 87, 'Rose&Night', '2025-01-18 19:44:43'),
(112, 10, 88, 'RaionSubs', '2025-01-18 20:48:20'),
(113, 10, 89, 'RaionSubs', '2025-01-18 20:48:41'),
(114, 14, 90, 'RaionSubs', '2025-01-18 20:55:33'),
(115, 14, 91, 'RaionSubs', '2025-01-18 20:56:06'),
(116, 15, 92, 'RaionSubs', '2025-01-18 21:00:46'),
(117, 15, 93, 'RaionSubs', '2025-01-18 21:01:17'),
(118, 15, 94, 'RaionSubs', '2025-01-18 21:01:42'),
(119, 16, 95, 'RaionSubs', '2025-01-19 09:39:43'),
(120, 17, 96, 'RaionSubs', '2025-01-19 12:37:20'),
(121, 17, 97, 'RaionSubs', '2025-01-19 12:39:40'),
(122, 17, 98, 'RaionSubs', '2025-01-19 12:40:01'),
(123, 17, 99, 'RaionSubs', '2025-01-19 12:40:30'),
(124, 17, 100, 'RaionSubs', '2025-01-19 12:40:48'),
(125, 17, 101, 'RaionSubs', '2025-01-19 12:43:14'),
(126, 17, 102, 'RaionSubs', '2025-01-19 12:43:38'),
(127, 17, 103, 'RaionSubs', '2025-01-19 12:43:56'),
(128, 17, 104, 'RaionSubs', '2025-01-19 12:44:17'),
(129, 17, 105, 'RaionSubs', '2025-01-19 12:44:41'),
(130, 17, 106, 'RaionSubs', '2025-01-19 12:45:36'),
(131, 17, 107, 'RaionSubs', '2025-01-19 12:46:29'),
(132, 15, 94, 'MoonSubs', '2025-01-19 15:29:54'),
(133, 18, 108, 'Moon Subs', '2025-01-19 15:38:35'),
(139, 19, 114, 'Moon Subs', '2025-01-19 16:18:26'),
(140, 19, 115, 'Moon Subs', '2025-01-19 16:18:44'),
(141, 19, 116, 'Moon Subs', '2025-01-19 16:19:04'),
(142, 19, 117, 'Moon Subs', '2025-01-19 16:19:59'),
(143, 19, 118, 'Moon Subs', '2025-01-19 16:20:49'),
(144, 19, 119, 'Moon Subs', '2025-01-19 16:21:08'),
(145, 19, 120, 'Moon Subs', '2025-01-19 16:21:30'),
(146, 19, 121, 'Moon Subs', '2025-01-19 16:22:10'),
(147, 19, 122, 'Moon Subs', '2025-01-19 16:22:29'),
(148, 19, 123, 'Moon Subs', '2025-01-19 16:22:57'),
(149, 19, 124, 'Moon Subs', '2025-01-19 16:23:18'),
(150, 19, 125, 'Moon Subs', '2025-01-19 16:23:36'),
(151, 21, 126, 'Torako Subs', '2025-01-20 18:38:18'),
(152, 21, 127, 'Torako Subs', '2025-01-20 18:39:57'),
(153, 21, 128, 'Torako Subs', '2025-01-20 18:40:37'),
(154, 21, 129, 'Torako Subs', '2025-01-20 18:41:03'),
(155, 21, 130, 'Torako Subs', '2025-01-20 18:41:36'),
(156, 21, 131, 'Torako Subs', '2025-01-20 18:42:05'),
(157, 21, 132, 'Torako Subs', '2025-01-20 18:42:35'),
(158, 21, 133, 'Torako Subs', '2025-01-20 18:43:02'),
(159, 22, 134, 'Torako Subs', '2025-01-20 18:51:47'),
(161, 16, 136, 'Torako Subs', '2025-01-20 18:59:55'),
(162, 16, 137, 'Torako Subs', '2025-01-20 19:00:40'),
(163, 15, 92, 'Torako Subs', '2025-01-20 19:01:35'),
(164, 15, 93, 'Torako Subs', '2025-01-20 19:02:25'),
(165, 15, 94, 'Torako Subs', '2025-01-20 19:02:45'),
(166, 23, 138, 'Torako Subs', '2025-01-20 19:08:34'),
(167, 23, 139, 'Torako Subs', '2025-01-20 19:09:44'),
(168, 23, 140, 'Torako Subs', '2025-01-20 19:10:12'),
(169, 23, 141, 'Torako Subs', '2025-01-20 19:10:37'),
(170, 25, 142, 'Torako Subs', '2025-01-20 19:21:39'),
(171, 25, 143, 'Torako Subs', '2025-01-20 19:22:03'),
(174, 26, 146, 'Eksen Ceviri', '2025-01-20 20:03:20'),
(175, 26, 147, 'Eksen Ceviri', '2025-01-20 20:05:54'),
(176, 26, 148, 'Eksen Ceviri', '2025-01-20 20:06:41'),
(177, 26, 149, 'Eksen Ceviri', '2025-01-20 20:06:58'),
(178, 26, 150, 'Eksen Ceviri', '2025-01-20 20:07:58'),
(179, 26, 151, 'Eksen Ceviri', '2025-01-20 20:08:26'),
(180, 26, 152, 'Eksen Ceviri', '2025-01-20 20:08:43'),
(181, 26, 153, 'Eksen Ceviri', '2025-01-20 20:09:03'),
(182, 26, 155, 'Eksen Ceviri', '2025-01-20 20:13:36'),
(183, 26, 156, 'Eksen Ceviri', '2025-01-20 20:14:11'),
(184, 26, 157, 'Eksen Ceviri', '2025-01-20 20:14:36'),
(185, 26, 158, 'Eksen Ceviri', '2025-01-20 20:15:13');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `fansub_links`
--

CREATE TABLE `fansub_links` (
  `id` int(11) NOT NULL,
  `fansub_id` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `fansub_links`
--

INSERT INTO `fansub_links` (`id`, `fansub_id`, `link`, `name`, `created_at`) VALUES
(26, 44, 'https://drive.google.com/file/d/1gtBeY10xNibSthi7LENKMZe3V2kNGJaf/preview', 'Gdrive', '2024-10-28 10:38:32'),
(27, 45, 'https://drive.google.com/file/d/1oguqZ6_Qm-wXjVpn4yZzg7lXYivanFPh/preview', 'Gdrive', '2024-10-28 10:39:26'),
(28, 46, 'https://drive.google.com/file/d/1pfliCtK1WJwusbNgRPrlOnrs0affG3qg/preview', 'Gdrive', '2024-10-28 10:40:15'),
(29, 47, 'https://drive.google.com/file/d/1m9uulIre0A1yzWh6U8pGYw4DcgSwbP9l/preview', 'Gdrive', '2024-10-28 10:41:07'),
(30, 48, 'https://drive.google.com/file/d/1Sh8yZ--YSuqcKmm0RKcNwD4Wr4DFjCQB/preview', 'Gdrive', '2024-10-28 10:41:43'),
(31, 49, 'https://drive.google.com/file/d/1Y_BHur3XLpHx1-X_WYRz7fExrA6S0Lh7/preview', 'Gdrive', '2024-10-28 10:42:44'),
(32, 50, 'https://drive.google.com/file/d/1kG83qCBew5vP2Gfnhe8rKULExLA0cJg0/view?usp=sharing', 'Gdrive', '2024-10-28 10:43:22'),
(33, 51, 'https://drive.google.com/file/d/1Mf8HNDG1d38w4xs6st0p4iYLntUdMhxe/preview', 'Gdrive', '2024-10-28 10:44:06'),
(34, 52, 'https://drive.google.com/file/d/1iBT8touCy9_eUEqiDal2dOr4FSA67Oym/preview', 'Gdrive', '2024-10-28 10:44:37'),
(35, 53, 'https://drive.google.com/file/d/1EMPL8z89uQ4C_2IXE7rK9iP1u1TXdYQS/preview', 'Gdrive', '2024-10-28 10:45:15'),
(36, 54, 'https://drive.google.com/file/d/1Wnyml3fRdZkiA7HePGbaeGYuOQRJ1IMV/preview', 'Gdrive', '2024-10-28 10:45:50'),
(37, 55, 'https://drive.google.com/file/d/1mjY3Qd3OHmiSaUQbXQGnyXKI8chQ20lp/preview', 'Gdrive', '2024-10-28 10:46:22'),
(38, 56, 'https://drive.google.com/file/d/1WP0kb5tjKRrLvjgy1LNSXMUNxI7byTuD/preview', 'Gdrive', '2024-10-28 18:51:36'),
(39, 57, 'https://drive.google.com/file/d/1Xc9yNzmCwu7y5PZtRZiF4pKRDkvlzbM5/preview', 'Gdrive', '2024-10-28 18:53:13'),
(40, 58, 'https://drive.google.com/file/d/15xtH5JfyBN-EpEZqRwT2XqsubGx0-8I_/preview', 'Gdrive', '2024-10-28 18:55:11'),
(41, 59, 'https://drive.google.com/file/d/1xTEdIicjDxDo3Y9_OEXYAjqUFb0slzTW/preview', 'Gdrive', '2024-10-28 18:55:37'),
(42, 60, 'https://drive.google.com/file/d/19PMtq4e0C_NhRN14XjT6nPF5MjrCGwWh/preview', 'Gdrive', '2024-10-28 18:56:04'),
(43, 61, 'https://drive.google.com/file/d/1etHbOZXDEZnV847qkzg3HG2ikHvtpUE7/preview', 'Gdrive', '2024-10-28 18:56:44'),
(44, 62, 'https://drive.google.com/file/d/1YZRJeAA_vRnYaW2Ej0Rr4Ltb4r8TZwLt/preview', 'Gdrive', '2024-10-28 18:58:07'),
(45, 63, 'https://drive.google.com/file/d/1MIAf4BZIbP5gHzYXcNaFwp9tVeR8TcDC/preview', 'Gdrive', '2024-10-28 19:00:07'),
(46, 64, 'https://drive.google.com/file/d/1AM7XO0UdD73AbWqQJE1_8MB5U8TTC-Sg/preview', 'Gdrive', '2024-10-28 19:00:56'),
(47, 65, 'https://drive.google.com/file/d/1aCHXHChw0ffba8ZnPcupyrMHs1mr6oEv/preview', 'Gdrive', '2024-10-28 19:02:22'),
(48, 66, 'https://drive.google.com/file/d/14YuCSBzJ4rqzRZmWdpVZowRNLz_IdEPu/preview', 'Gdrive', '2024-10-28 19:02:59'),
(52, 70, 'https://drive.google.com/file/d/13A58OyGkAQeuFgNfCYhMzXsgWPOzxnmC/preview', 'Gdrive', '2024-10-28 19:54:08'),
(53, 71, 'https://drive.google.com/file/d/1BocV-NyOTnr3VITWFoUo4c9Qwa7pSedp/preview', 'Gdrive', '2024-10-28 19:54:39'),
(54, 72, 'https://drive.google.com/file/d/1dUcXntsgQKSrhB4whz2X-9erYLQ1ZzkI/preview', 'Gdrive', '2024-10-28 19:55:15'),
(60, 78, 'https://drive.google.com/file/d/1Qq1sAHBVS0256cP5wbABjthdg9nfTFH2/preview', 'Gdrive', '2024-12-07 18:14:27'),
(61, 79, 'https://drive.google.com/file/d/1Y5bGiy_jI4YO5l4yDfHwhzQUeCRdccdq/preview', 'Gdrive', '2024-12-07 18:15:04'),
(63, 81, 'https://drive.google.com/file/d/1CscpMctoL9j9z8GXQi7_rlOKzG92rUNb/preview', 'Gdrive', '2024-12-08 11:57:05'),
(65, 83, 'https://drive.google.com/file/d/1-KqdKKEKSBJItsdBrYjKZe-3_7Q63Nia/preview', 'Gdrive', '2024-12-08 11:58:31'),
(68, 86, 'https://drive.google.com/file/d/1n_i-arbIUVJcHG4JK-2yyCfWasKbOQdo/view?usp=drive_link/preview', 'Gdrive', '2024-12-08 15:18:10'),
(69, 87, 'https://drive.google.com/file/d/1k51fePd8vC8VFFr3emue1_q7OPwAzOtJ/preview', 'Gdrive', '2024-12-08 15:19:01'),
(75, 92, 'https://drive.google.com/file/d/1mJhDjEkvgRJyabjw6_11gj8D7yrBuud3/preview', 'Gdrive', '2024-12-08 15:25:05'),
(77, 94, 'https://drive.google.com/file/d/1oi8Fbl9zEiiMY2HBARXqff85_j1H9kVA/preview', 'Gdrive', '2025-01-18 18:36:11'),
(78, 95, 'https://drive.google.com/file/d/12DR1VNjBDZ0kUBiViz0U4iiqo_1NU_a9/preview', 'Gdrive', '2025-01-18 18:36:50'),
(79, 96, 'https://drive.google.com/file/d/1T_QlHa4HimJyBrMDUaosTB3s55YfrKAi/preview', 'Gdrive', '2025-01-18 18:37:20'),
(80, 97, 'https://drive.google.com/file/d/1tehDy8HBG1a7Jc8mTaNyWbFkixHIAGKG/preview', 'Gdrive', '2025-01-18 18:38:15'),
(81, 98, 'https://drive.google.com/file/d/1oppHFkvjhGxagoyDbyY4fscCTPnBbxgA/preview', 'Gdrive', '2025-01-18 18:38:59'),
(82, 99, 'https://drive.google.com/file/d/1jXsXBHbCoTamlJ9Umib5kJn-QZ1Z3yo6/preview', 'Gdrive', '2025-01-18 18:47:24'),
(83, 100, 'https://drive.google.com/file/d/1KuRojffPo1dcEQuWlOXH-i4M3wRrUX8e/preview', 'Gdrive', '2025-01-18 18:47:49'),
(84, 101, 'https://drive.google.com/file/d/1lfpdYwl84ZMdoKGjIjBFhIG-jgSTxg0-/preview', 'Gdrive', '2025-01-18 18:48:15'),
(85, 102, 'https://drive.google.com/file/d/12ZnsYAtEdLYgUyv4beLvphtrG1FRsNay/preview', 'Gdrive', '2025-01-18 18:49:59'),
(86, 103, 'https://drive.google.com/file/d/14FiLBWrWJRcjG5MvcZjgMq67HUkNQxuH/preview', 'Gdrive', '2025-01-18 18:51:26'),
(87, 104, 'https://drive.google.com/file/d/1IlULtDinFgME_JmBRzHfDEAi5xCoL4gP/preview', 'Gdrive', '2025-01-18 18:52:16'),
(88, 105, 'https://drive.google.com/file/d/1S-R-XLEuX3gJo6YBFsYLI0AVsRmhJr-I/preview', 'Gdrive', '2025-01-18 18:55:10'),
(89, 106, 'https://drive.google.com/file/d/1s0jSa1XHkphbD488z2u4vzpIZgoBAnoi/preview', 'Gdrive', '2025-01-18 18:55:32'),
(91, 107, 'https://drive.google.com/file/d/1TqsUTXQqImG-KUqw-2I2pW-Ko7wBdt3k/preview', 'Gdrive', '2025-01-18 18:56:25'),
(92, 108, 'https://drive.google.com/file/d/13kzxBGkiV1HfIOSPzOnYbUZHLvYOUMhm/preview', 'Gdrive', '2025-01-18 19:40:53'),
(93, 109, 'https://drive.google.com/file/d/17NiFkU4alFaD-N1Q-9Ki112NxcpNp3YC/preview', 'Gdrive', '2025-01-18 19:41:36'),
(94, 110, 'https://drive.google.com/file/d/19_9w9sWguWHEdSQbo8_-MjqeM3T4b14_/preview', 'Gdrive', '2025-01-18 19:42:17'),
(95, 111, 'https://drive.google.com/file/d/1sw1nFUv0vTkXq8CxmU8gkSWG8yj42KDJ/preview', 'Gdrive', '2025-01-18 19:44:47'),
(96, 112, 'https://drive.google.com/file/d/1M-DmCHXCoeEHoBVjiRnJ8RXGAViVwzCG/preview', 'Gdrive', '2025-01-18 20:48:24'),
(97, 113, 'https://drive.google.com/file/d/1igBEz04N5CQB5u7EGQRKs0J7hcFH-ZgT/preview', 'Gdrive', '2025-01-18 20:48:50'),
(98, 114, 'https://drive.google.com/file/d/1hgxZiJ9VqwDWHEkAEIvjOIaniCrlUvNH/preview', 'Gdrive', '2025-01-18 20:55:37'),
(99, 115, 'https://drive.google.com/file/d/1jRW4n7KstNnobppuX7qbd-MG3iESVAYa/preview', 'Gdrive', '2025-01-18 20:56:11'),
(100, 116, 'https://drive.google.com/file/d/12Vs_DfFNyAFeqYHF_D6I_hSjcRX7OV2b/preview', 'Gdrive', '2025-01-18 21:00:49'),
(101, 117, 'https://drive.google.com/file/d/1JKO-JXwahGYE09vTvW6LN02bCNuVEaYp/preview', 'Gdrive', '2025-01-18 21:01:21'),
(102, 118, 'https://drive.google.com/file/d/1_Uw9qHUwL5zyRWjaVBdImorjDiYzK1Ez/preview', 'Gdrive', '2025-01-18 21:01:47'),
(103, 119, 'https://drive.google.com/file/d/1NVl4AR2s8aLL_Abboojbdbkr5t6-3z-N/preview', 'Gdrive', '2025-01-19 09:39:47'),
(104, 120, 'https://drive.google.com/file/d/1tAvDSEyVKhDNzqSTUbxjTvhW8FlyouXq/preview', 'Gdrive', '2025-01-19 12:37:24'),
(105, 121, 'https://drive.google.com/file/d/1VAsbdHCocWeKF8uY6S6rVD5YqwI4B03L/preview', 'Gdrive', '2025-01-19 12:39:43'),
(106, 122, 'https://drive.google.com/file/d/1j6x_1Fz6ppzjEZ2gNxgxf2L20OaG19rK/preview', 'Gdrive', '2025-01-19 12:40:06'),
(107, 123, 'https://drive.google.com/file/d/1Ho1Xsm2cVPcy-G-JRvPOQ5yB_EF_ezBx/preview', 'Gdrive', '2025-01-19 12:40:35'),
(108, 124, 'https://drive.google.com/file/d/1YUCjW_GADPY2umxTBJ_tiV5RU6XzZKV7/preview', 'Gdrive', '2025-01-19 12:40:52'),
(109, 125, 'https://drive.google.com/file/d/1G9LJQglqUulNi8KnhPZA2SLZFcUOZ6l9/preview', 'Gdrive', '2025-01-19 12:43:21'),
(110, 126, 'https://drive.google.com/file/d/1CpYE9w_FnDa1gXKInAAkAWwcRwvXXTzj/preview', 'Gdrive', '2025-01-19 12:43:43'),
(111, 127, 'https://drive.google.com/file/d/1T_Fr2ldKpy3PQsHXrd3WcXDRZVtlMBMz/preview', 'Gdrive', '2025-01-19 12:44:00'),
(112, 128, 'https://drive.google.com/file/d/1aqVhrK0RuPDsy37PNeKf1tgh3JoGfaW_/preview', 'Gdrive', '2025-01-19 12:44:22'),
(113, 129, 'https://drive.google.com/file/d/1665dAVSckrL4yroJiD1OOcKMOhxb33yt/preview', 'Gdrive', '2025-01-19 12:44:46'),
(114, 130, 'https://drive.google.com/file/d/1Fa5WIqHPEduIdjVy5T94L9StK5HEalG8/preview', 'Gdrive', '2025-01-19 12:45:40'),
(115, 131, 'https://drive.google.com/file/d/1Ehbc68VZaFoR5KlIOHf-5IPZMPWUZE4L/preview', 'Gdrive', '2025-01-19 12:46:33'),
(118, 132, 'https://drive.google.com/file/d/18iyysYoNsiIIylgaMxR2pZooA5Aw3Uex/preview', 'Gdrive', '2025-01-19 15:30:26'),
(119, 133, 'https://drive.google.com/file/d/1DsidDqaqcqpDX1bfKC4rDHjX11HQxhmM/preview', 'Gdrive', '2025-01-19 15:38:39'),
(125, 139, 'https://drive.google.com/file/d/19DfrxTrmTTycuN-LnF3EgcmVVb-fI2uh/preview', 'Gdrive', '2025-01-19 16:18:31'),
(126, 140, 'https://drive.google.com/file/d/19FYbT9daqhiiS9BeI8GS914PX38Pairg/preview', 'Gdrive', '2025-01-19 16:18:48'),
(127, 141, 'https://drive.google.com/file/d/19HLy7ITERr5Y0qh48fIkyNXqcvaePwZd/preview', 'Gdrive', '2025-01-19 16:19:27'),
(128, 142, 'https://drive.google.com/file/d/19MupsbjVvRcxS1cMKPlLQ04pDJ_fK6zG/preview', 'Gdrive', '2025-01-19 16:20:03'),
(129, 143, 'https://drive.google.com/file/d/19Ue2IZojttyWWDC2OKg1JhkaO6fTNtym/preview', 'Gdrive', '2025-01-19 16:20:54'),
(130, 144, 'https://drive.google.com/file/d/19VXSU6cd0CbmgFlwQoDWNeMn3rkueF88/preview', 'Gdrive', '2025-01-19 16:21:14'),
(131, 145, 'https://drive.google.com/file/d/19Vd-5crRaMt34v9LEVN8NTTr0nF1KWDg/preview', 'Gdrive', '2025-01-19 16:21:35'),
(132, 146, 'https://drive.google.com/file/d/19_flQgPJCA4mBAt8jOb0labx8KVVfks3/preview', 'Gdrive', '2025-01-19 16:22:15'),
(133, 147, 'https://drive.google.com/file/d/19gPkKVOETRICOGqH5', 'Gdrive', '2025-01-19 16:22:33'),
(134, 148, 'https://drive.google.com/file/d/19qXHXT0ajaPPKoJxLuwaOyVvGUQ92j0k/preview', 'Gdrive', '2025-01-19 16:23:02'),
(135, 149, 'https://drive.google.com/file/d/1ANylcm2zW4bt-tcQFUnWKsOfqY-13_pM/preview', 'Gdrive', '2025-01-19 16:23:21'),
(136, 150, ' https://drive.google.com/file/d/1ASNJMxtCWLsRC2UoYvDi_is2WBCMpiJl/preview', 'Gdrive', '2025-01-19 16:23:41'),
(137, 151, 'https://drive.google.com/file/d/1CT9LIC5gkBw50pcnIIjNcIfmWFck4viW/preview', 'Gdrive', '2025-01-20 18:38:22'),
(139, 152, 'https://drive.google.com/file/d/1hpP1bVsqcoSn60RHjk5KOZinRPBBwlS3/preview', 'Gdrive', '2025-01-20 18:40:01'),
(140, 153, 'https://drive.google.com/file/d/1NCR8uCwYfg7an05xiRi0kNp2pEe-mZkp/preview', 'Gdrive', '2025-01-20 18:40:41'),
(141, 154, 'https://drive.google.com/file/d/1fwjkxztvGMm_-CgKn2VXarQLMNHlUrLj/preview', 'Gdrive', '2025-01-20 18:41:07'),
(142, 155, 'https://drive.google.com/file/d/1iX3GQ1PC0fS3FsUBAieasipJIyarvfqm/preview', 'Gdrive', '2025-01-20 18:41:40'),
(143, 156, 'https://drive.google.com/file/d/15DdicAzcMJf7Xcubxg_BN8nuDNSSazX0/preview', 'Gdrive', '2025-01-20 18:42:10'),
(144, 157, 'https://drive.google.com/file/d/1e2OsWcSqsSmfwSXeerOl5nOCVAAMBLuo/preview', 'Gdrive', '2025-01-20 18:42:39'),
(145, 158, 'https://drive.google.com/file/d/1XugqsVU7L2IcrD5hxbjSl1m6gXY77MNj/preview', 'Gdrive', '2025-01-20 18:43:05'),
(146, 159, 'https://drive.google.com/file/d/1wR45d4MNstdbxEZhHSY4Ho_ZuCzp_Kvv/preview', 'Gdrive', '2025-01-20 18:51:51'),
(148, 161, 'https://drive.google.com/file/d/1LbHwis68z4n07xJ2yeJx-NKHqUZS0lsr/preview', 'Gdrive', '2025-01-20 18:59:59'),
(149, 162, 'https://drive.google.com/file/d/1NJutdf41IqRibp2K808G2OnyifarS2j-/preview', 'Gdrive', '2025-01-20 19:00:45'),
(150, 163, 'https://drive.google.com/file/d/1LbHwis68z4n07xJ2yeJx-NKHqUZS0lsr/preview', 'Gdrive', '2025-01-20 19:02:06'),
(151, 164, 'https://drive.google.com/file/d/1NJutdf41IqRibp2K808G2OnyifarS2j-/preview', 'Gdrive', '2025-01-20 19:02:33'),
(152, 165, 'https://drive.google.com/file/d/12Z2koKuGRzr3wkb4CiqbQ6832gpQUe19/preview', 'Gdrive', '2025-01-20 19:03:00'),
(153, 166, 'https://drive.google.com/file/d/1RjXJegSphbG55-e53eyNXK73NbdPxuzX/preview', 'Gdrive', '2025-01-20 19:08:41'),
(154, 167, 'https://drive.google.com/file/d/1QzFZeI_zL7CHddov4DwVrjAxppkCpzEv/preview', 'Gdrive', '2025-01-20 19:09:48'),
(155, 168, 'https://drive.google.com/file/d/1D4OUmCqmjBoLL-BNK3kUREzfbY1sPLOJ/preview', 'Gdrive', '2025-01-20 19:10:16'),
(156, 169, 'https://drive.google.com/file/d/119urY0Pew-yqHWQpNfr_sQoeaZCsKLEX/preview', 'Gdrive', '2025-01-20 19:10:41'),
(157, 170, 'https://drive.google.com/file/d/1qlz9b0-IoRzyOvH_8AKN4qJ0_lvNC0-K/preview ', 'Gdrive', '2025-01-20 19:21:43'),
(158, 171, 'https://drive.google.com/file/d/1jV5SMLlRBlqQQdRRGHz8_7V0RmRPWHhJ/preview ', 'Gdrive', '2025-01-20 19:22:06'),
(162, 174, 'https://drive.google.com/file/d/1Q6OSc0HMBiCmvmwiVUQqBRBe2t_NZ8om/preview', 'Gdrive', '2025-01-20 20:03:27'),
(163, 175, 'https://drive.google.com/file/d/1W20L_lgo0FHWesKMNF5OFtwbDQf47ZS_/preview ', 'Gdrive', '2025-01-20 20:05:57'),
(164, 176, 'https://drive.google.com/file/d/1impvRF7jbdbyyJZ6jEuG7KwDXp8SwRme/preview', 'Gdrive', '2025-01-20 20:06:47'),
(165, 177, 'https://drive.google.com/file/d/1bpxqOcEubv7gNBptXwgpJ9uBo14v8dJV/preview', 'Gdrive', '2025-01-20 20:07:02'),
(166, 178, 'https://drive.google.com/file/d/1YETCOM7p-Fp7H9-AtX7RzxJz_9Z_Wa_q/preview', 'Gdrive', '2025-01-20 20:08:02'),
(167, 179, 'https://drive.google.com/file/d/1CYace8pBI_xN24JFrFAeDTr7BU_t6CXR/preview', 'Gdrive', '2025-01-20 20:08:29'),
(168, 180, 'https://drive.google.com/file/d/12J04UwjTMiXz456waIFVMpeorfBXM_VD/preview', 'Gdrive', '2025-01-20 20:08:46'),
(169, 181, 'https://drive.google.com/file/d/1huqHXSPDM3pVVHaceRI70i222-M_vYbh/preview', 'Gdrive', '2025-01-20 20:09:08'),
(170, 182, 'https://drive.google.com/file/d/1gU26tgPrNaBlyz74fdeBNnRaEkWNSRNB/preview', 'Gdrive', '2025-01-20 20:13:41'),
(171, 183, 'https://drive.google.com/file/d/16Y6gBcdc92LiApLHnciB06ApRPHyP0Ag/preview ', 'Gdrive', '2025-01-20 20:14:14'),
(172, 184, 'https://drive.google.com/file/d/1QqEr3suVEd5SIPKsZlNzG_glMLfMXv_f/preview ', 'Gdrive', '2025-01-20 20:14:40'),
(173, 185, 'https://drive.google.com/file/d/1HvO8INl3Ode7hwTGmORkunNzn6xgrwT8/preview ', 'Gdrive', '2025-01-20 20:15:18');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `form`
--

CREATE TABLE `form` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `reason` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `form`
--

INSERT INTO `form` (`id`, `name`, `email`, `phone`, `reason`, `description`, `created_at`) VALUES
(1, 'DSAew', 'sdasdadas@gmail.com', '', 'DSA', 'ew', '2024-10-26 18:27:48');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `genre`
--

CREATE TABLE `genre` (
  `1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `id` int(11) NOT NULL,
  `kullanici_adi` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `sifre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('kurucu','admin','mod','user') DEFAULT 'user',
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_image` varchar(255) DEFAULT 'default.jpg',
  `description` text DEFAULT 'No description available for this user.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `role`, `password`, `created_at`, `profile_image`, `description`) VALUES
(4, 'FrostSubs', 'Frostsubscom.tr@gmail.com', 'admin', '$2y$10$AUcFBAeVlTZZ.pKRm6MO6eCxZhW7NTsQwKyxmUdYMNoRouF/fZ/yS', '2024-10-27 19:15:15', 'https://m.media-amazon.com/images/I/61JkuN5DYDS._AC_UF894,1000_QL80_.jpg', 'No description available for this user.'),
(6, 'Deneme', 'sdsasdadas@gmail.com', 'admin', '$2y$10$68pKnkvmjkc5iEbsy4OJROVdUxfBAqYPrGGnULjWSHwBD1dksefGq', '2024-10-29 12:45:17', 'default.jpg', 'No description available for this user.'),
(8, 'sdasdasd', 'deneeeme@gmail.com', 'user', '$2y$10$TinpXWdPri5hLiW9BzC6dumdvG/JQ1ujgbD9Gg8ScrIthplNuyTW6', '2024-10-29 12:52:20', 'default.jpg', 'No description available for this user.'),
(9, 'HKD', 'husnukuzey47@gmail.com', 'user', '$2y$10$HIPiwad7qtGucVM/kYOdieJbu9ojXriLvfh06fN.LOL44szlHHSoK', '2024-10-29 13:03:04', 'default.jpg', 'No description available for this user.'),
(10, 'neleryokki', '5421690580@errere', 'user', '$2y$10$HXo5/872NPSCXytdBKvqB.q6EY7SAgwBz5VmGFCDE1IeBQCOnxnV2', '2025-01-18 18:02:06', 'default.jpg', 'No description available for this user.'),
(11, 'AlperenS', 'saygisizalperen@gmail.com', 'user', '$2y$10$eS9wRj02c.O2It9vjWTnxuoy/qKzqFe7ofXK/0xTXTJGtPd0sUPnO', '2025-01-18 18:31:32', 'default.jpg', 'No description available for this user.'),
(12, 'admin@admin', 'admin@admin', 'user', '$2y$10$.QfYAGMcM7C203ulwjuyWOrTDQNomS/PLPexq8u9W/rdVdFEeDfx6', '2025-01-19 13:43:22', 'default.jpg', 'No description available for this user.'),
(15, 'MoonSubs', 'moonsubsx@gmail.com', 'admin', '$2y$10$phmPuxHtlKHFTgmuf72aN.Su7CNdHstN864iKFWU5p8js05zKxrq2', '2025-01-19 15:46:43', 'default.jpg', 'Moonsubs Resmi Hesabıdır'),
(16, 'Meryem', 'Meryem05@gmail.com', 'user', '$2y$10$mlG.3YP.zrliICR1UqjynOA9wf8zuNT/b6mj9PXgOIx7maswAl7CG', '2025-01-19 17:37:44', 'https://media1.giphy.com/media/a6pzK009rlCak/giphy.gif?cid=6c09b952jznmlqpmxnnmxe5l1z86y939o94f4ylva0fgidwz&ep=v1_gifs_search&rid=giphy.gif&ct=g', 'No description available for this user.');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorumlar`
--

CREATE TABLE `yorumlar` (
  `id` int(11) NOT NULL,
  `anime_id` int(11) DEFAULT NULL,
  `kullanici_id` int(11) DEFAULT NULL,
  `icerik` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `animeler`
--
ALTER TABLE `animeler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `animes`
--
ALTER TABLE `animes`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `bolumler`
--
ALTER TABLE `bolumler`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anime_id` (`anime_id`);

--
-- Tablo için indeksler `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anime_id` (`anime_id`);

--
-- Tablo için indeksler `episodes`
--
ALTER TABLE `episodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anime_id` (`anime_id`);

--
-- Tablo için indeksler `fansubs`
--
ALTER TABLE `fansubs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anime_id` (`anime_id`),
  ADD KEY `episode_id` (`episode_id`);

--
-- Tablo için indeksler `fansub_links`
--
ALTER TABLE `fansub_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fansub_id` (`fansub_id`);

--
-- Tablo için indeksler `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Tablo için indeksler `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anime_id` (`anime_id`),
  ADD KEY `kullanici_id` (`kullanici_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `animeler`
--
ALTER TABLE `animeler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `animes`
--
ALTER TABLE `animes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Tablo için AUTO_INCREMENT değeri `bolumler`
--
ALTER TABLE `bolumler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `episodes`
--
ALTER TABLE `episodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- Tablo için AUTO_INCREMENT değeri `fansubs`
--
ALTER TABLE `fansubs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- Tablo için AUTO_INCREMENT değeri `fansub_links`
--
ALTER TABLE `fansub_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- Tablo için AUTO_INCREMENT değeri `form`
--
ALTER TABLE `form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Tablo için AUTO_INCREMENT değeri `yorumlar`
--
ALTER TABLE `yorumlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `bolumler`
--
ALTER TABLE `bolumler`
  ADD CONSTRAINT `bolumler_ibfk_1` FOREIGN KEY (`anime_id`) REFERENCES `animeler` (`id`);

--
-- Tablo kısıtlamaları `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`anime_id`) REFERENCES `animes` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `episodes`
--
ALTER TABLE `episodes`
  ADD CONSTRAINT `episodes_ibfk_1` FOREIGN KEY (`anime_id`) REFERENCES `animes` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `fansubs`
--
ALTER TABLE `fansubs`
  ADD CONSTRAINT `fansubs_ibfk_1` FOREIGN KEY (`anime_id`) REFERENCES `animes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fansubs_ibfk_2` FOREIGN KEY (`episode_id`) REFERENCES `episodes` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `fansub_links`
--
ALTER TABLE `fansub_links`
  ADD CONSTRAINT `fansub_links_ibfk_1` FOREIGN KEY (`fansub_id`) REFERENCES `fansubs` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD CONSTRAINT `yorumlar_ibfk_1` FOREIGN KEY (`anime_id`) REFERENCES `animeler` (`id`),
  ADD CONSTRAINT `yorumlar_ibfk_2` FOREIGN KEY (`kullanici_id`) REFERENCES `kullanicilar` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
