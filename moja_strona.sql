-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Час створення: Січ 26 2025 р., 18:02
-- Версія сервера: 10.4.32-MariaDB
-- Версія PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `moja_strona`
--

-- --------------------------------------------------------

--
-- Структура таблиці `kategorki`
--

CREATE TABLE `kategorki` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `matka` int(11) NOT NULL DEFAULT 0,
  `nazwa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `kategorki`
--

INSERT INTO `kategorki` (`id`, `matka`, `nazwa`) VALUES
(1, 0, 'Elektronika'),
(2, 1, 'Telefony'),
(3, 1, 'Laptopy'),
(4, 0, 'Dom'),
(5, 4, 'Meble'),
(6, 4, 'Wyposażenie');

-- --------------------------------------------------------

--
-- Структура таблиці `page_list`
--

CREATE TABLE `page_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_content` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `page_list`
--

INSERT INTO `page_list` (`id`, `page_title`, `page_content`, `status`) VALUES
(1, 'BurjKhalifa', '\r\n	<h1>Burdż Chalifa</h1>\r\n	<p class=\"txt1\">\r\n		<img class=\"img1\" src=\"https://www.allplan.com/fileadmin/_processed_/6/5/csm_iStock-183346577_NEU_b998568fdd.jpg\" alt=\"Burj Khalifa\" >\r\n		Burdż Chalifa (arab. برج خليفة, Burǧ Ḫalīfa, Burj Khalifa, po polsku także: Wieża Chalify, przed otwarciem: Burdż Dubajj, arab., Burǧ Dubayy, Burj Dubai, pol. Wieża Dubaju) – wieżowiec w Dubaju, w Zjednoczonych Emiratach Arabskich, zbudowany przez przedsiębiorstwa Samsung Constructions, BESIX i Arabtec, o wysokości 828 metrów. Najwyższy budynek świata, który pobił rekord wysokości dla budowli dzierżony wcześniej przez polski Maszt radiowy w Konstantynowie (646m). Jego nazwa pochodzi od imienia szejka Chalify ibn Zajida Al Nahajjana, byłego prezydenta Zjednoczonych Emiratów Arabskich.  Budowa, rozpoczęta 21 września 2004, zakończyła się 16 sierpnia 2009. Wysokość 827,9 metrów została osiągnięta 17 stycznia 2009, a oficjalne otwarcie nastąpiło 4 stycznia 2010. Budynek ma 163 piętra użytkowe. Koszt jego budowy wyniósł 1,5 miliarda dolarów.\r\n	</p>\r\n	<h2 class=\"txt1\">Wygląd i wystrój</h2>\r\n	<p class=\"txt1\">\r\n		<img class=\"img3\" src=\"https://images.pexels.com/photos/3567218/pexels-photo-3567218.jpeg?cs=srgb&dl=pexels-tom-li-1943126-3567218.jpg&fm=jpg\" alt=\"Burj Khalifa\">\r\n		Wieżowiec Burdż Chalifa zaprojektowany został przez przedsiębiorstwo architektoniczne Skidmore, Owings and Merrill, które projektowało także budynki Willis Tower oraz 1 World Trade Center. Ogólny jego wygląd nawiązuje do kwiatu pustyni z rodzaju Hymenocallis[7] oraz architektury islamu (różne ornamenty). Budowla składa się z centralnego rdzenia oraz trzech „ramion”, które w miarę zwiększania się wysokości są coraz mniejsze, co nadaje jej smukłość. Na samym szczycie centralny rdzeń przechodzi w iglicę. Najniższe piętra przeznaczono na hotel, którego wystrojem zajął się Giorgio Armani.\r\n	</p>\r\n	<h2 class=\"txt1\">Rozmiary</h2>\r\n	<p class=\"txt1\">\r\n		<img class=\"img1\" src=\"https://images.pexels.com/photos/162031/dubai-tower-arab-khalifa-162031.jpeg?cs=srgb&dl=pexels-pixabay-162031.jpg&fm=jpg\" alt=\"Burj Khalifa\">\r\n		Początkowo konstrukcja miała mieć wysokość około 100 metrów i wykorzystywała projekt niewybudowanej nigdy wieży Grollo Tower w Melbourne w Australii. Niedługo potem przedsiębiorstwo Skidmore, Owings and Merrill nadało budynkowi obecny kształt i wygląd, podnosząc jego wysokość najpierw do 650, a później do 705 metrów. Główny architekt, Adrian Smith, uznał jednak, że górne partie budynku nie wyglądają odpowiednio i postanowił jeszcze bardziej zwiększyć wysokość konstrukcji, by nadać wieżowcowi smuklejszy wygląd. Szczytowe partie budynku, od piętra 154 wzwyż, są zbudowane tylko na lekkiej stalowej konstrukcji (a nie na żelbetowym szkielecie, jak niższe piętra). Inwestor (przedsiębiorstwo Emaar) uważał, że w ten sposób szczyt wieży będzie mógł być podwyższony, by pobić ewentualnych konkurentów do tytułu najwyższego budynku świata – jednak gdy budowę ukończono, nie jest to możliwe.\r\n		17 stycznia 2009 wieżowiec osiągnął docelową wysokość 828 m.\r\n	</p>\r\n	<h2 class=\"txt1\">Rekordy</h2>\r\n	<p class=\"txt1\">\r\n		<img class=\"img3\" src=\"https://www.visitdubai.com/-/media/gathercontent/poi/b/burj-khalifa/fallback-image/poi-burj-khalifa-3-dtcm-jun-2023.jpg\" alt=\"Burj Khalifa\">\r\n		Burdż Chalifa:\r\n		20 maja 2008 stał się najwyższą lądową konstrukcją budowlaną, jaką kiedykolwiek zbudowano (tytuł ten odebrał polskiemu masztowi radiowemu w Konstantynowie, który miał 646 metrów wysokości; uległ on zniszczeniu 8 sierpnia 1991).\r\n		13 września 2007 stał się najwyższą budowlą wolno stojącą (tytuł ten odebrał kanadyjskiej CN Tower, mającej 553 metry wysokości).\r\n		21 lipca 2007 stał się najwyższym wieżowcem na świecie[8] (tytuł ten odebrał Taipei 101, w Republice Chińskiej, mającemu 509 metrów wysokości).\r\n		W wyniku problemów spowodowanych bankructwem przedsiębiorstwa odpowiedzialnego za elewację pierwsze jej elementy pojawiły się na budynku dopiero w połowie 2007. Do czasu jej montażu Burdż Chalifa był więc najwyższym betonowym szkieletem nieukończonego budynku, wyższym niż hotel Rjugjong w Korei Północnej, mający 105 pięter i 330 metrów wysokości, który miał ten tytuł do 2006.\r\n	</p>\r\n	<h2 class=\"txt1\">Strajk robotników</h2>\r\n	<p class=\"txt1\">\r\n		<img class=\"img1\" src=\"https://www.tomorrow.city/wp-content/uploads/2023/10/Burj_Khalifa_1.jpg\" alt=\"Burj Khalifa\">\r\n		Pracownicy budujący Wieżę Chalify skarżyli się na niskie płace i złe warunki pracy. Według danych z prasy zarobek doświadczonego cieśli wynosił 7,60 USD dziennie, a pracownik niewykwalifikowany zarabiał 4 USD. Niektórzy pracodawcy zatrzymywali paszporty swoich pracowników do ukończenia budowy, a pensje były wypłacane z opóźnieniem. W ZEA istnienie związków zawodowych jest zabronione, dlatego 21 marca 2006 wybuchły ogromne zamieszki, a pracownicy zniszczyli samochody, biura i budynki w pobliżu budowy. Według urzędników szkody wyniosły około 20 milionów euro. Pracownicy następnego dnia zaczęli strajk i przyłączyli się do strajkujących robotników z dubajskiego lotniska, lecz po negocjacjach wrócili do pracy.\r\n	</p>\r\n\r\n', 1),
(2, 'Merdeka118', '\r\n\r\n	<h1>Merdeka 118 </h1>\r\n	<p class=\"txt1\">\r\n		<img class=\"img1\" src=\"https://upload.wikimedia.org/wikipedia/commons/thumb/f/fb/Merdeka_118_2023-08-20.jpg/800px-Merdeka_118_2023-08-20.jpg\">\r\n		Merdeka 118 znana jest również pod nazwą Menara Warisan Merdeka lub jako skrótowiec KL118 stworzony od pierwszych liter miasta Kuala Lumpur oraz ilości pięter wieżowca, których jest właśnie 118. Słowo „merdeka” w języku malajskim oznacza „niepodległość”, a więc pełną nazwę wieżowca można przetłumaczyć jako „Wieża Dziedzictwa Niepodległości”.\r\n\r\n	</p>\r\n\r\n	<p class=\"txt1\">\r\n		<img class=\"img3\" src=\"https://constructalia.arcelormittal.com/files/Meredeka+118-1_web--4d1379b5f2266abdc76118977a424df3.jpg\">\r\n		Wieżowiec, który zajął niemal 8 hektarową działkę w centralnej części stolicy Malezji, został ukończony pod koniec 2023 roku, jednak dopiero teraz został oddany do użytku. Budowa tego kolosa trwała 9 lat. Pierwsze prace budowlane ruszyły w 2014 roku. Siedem lat później, w 2021 roku, wieżowiec osiągnął docelową wysokość, stając się najwyższym budynkiem w kraju i w całej Azji południowo-wschodniej, a także drugą najwyższą konstrukcją na świecie. Inwestorem, który wybudował obiekt jest malezyjski fundusz inwestycyjny Permodalan Nasional Berhad. Koszt budowy szacuje się na ponad 4 miliardy złotych (ok. 1 miliard dolarów).\r\n\r\n	</p>\r\n\r\n	<p class=\"txt1\">\r\n		<img class=\"img1\" src=\"https://sztuka-architektury.pl/assets/front/images/content/Yo5m3LZkehZelftDJMHQ0JBKUGmSmj5iSdmjyqJG23q5jCWzH0t1iS4l4OPU_merdeka-118-fender-katsalidis-architecture-supertall-skyscraper-malaysia-dezeen-2364-col-2-1704x2005-1jpg.jpg\">\r\n		Merdeka 118 będzie również jednym z najbardziej ekologicznych obiektów na świecie. Jako pierwszy obiekt w Malezji osiągnął potrójny platynowy certyfikat LEED, który oznacza, że właściciel obiektu dołożył wszelkich starań, a także dysponuje wiedzą w zakresie ekologicznego budownictwa i użytkowania budynku. To bardzo istotne, gdyż obiekt oferuje obecnie ponad 400.000 metrów kwadratowych przestrzeni użytkowej.\r\n\r\n	</p>\r\n	<h2 class=\"txt4\">Co znajdzie się w Merdeka 118?</h2>\r\n	<p class=\"txt1\">\r\n		<img class=\"img3\" src=\"https://www.whitemad.pl/wp-content/uploads/2024/01/Views_from_Kuala_Lumpur_Tower_2023_06-scaled.jpg\">\r\n		Obiekt bedzie łączył różne funkcje. Można powiedzieć, że wieżowiec będzie samowystarczalnym miastem w mieście. Znajdą to się zarówno biura, których stosunkowo będzie najwięcej, jednak w obiekcie zaplanowano również prywatne apartamenty, hotele, restauracja, centrum handlowe i rozrywkowe, a także placówki administracyjne. Na ostatnim, 118 piętrze wieżowca powstał VIP Club z widokiem na miasto. W budynku znajdzie się również gigantyczny parking zdolny pomieścić 8500 samochodów. Warto tu dodać, że 60 z 80 pięter biurowych zajmie sam inwestor – Permodalan Nasional Berhad.\r\n\r\n	</p>\r\n	<h2 class=\"txt1\">Wieżowiec Merdeka 118 – projekt i estetyka</h2>\r\n	<p class=\"txt1\">\r\n		<img class=\"img1\" src=\"https://i.iplsc.com/-/000FUUIEMQSSMON6-C461-F4.jpg\">\r\n		Obiekt został zaprojektowany w stylu futurystycznym przez architektów z pracowni Fender Katsalidis. Budynek został pokryty mozaiką szklanych fasad w kształcie rombów, co ma oznaczać różnorodność Malezyjczyków. Projekt został wykonany tak, aby przypominać gest wyciągniętej ręki Tunku Abdula Rahmana podczas skandowania „Merdeka!”, czyli „Niepodłegłość!”, kiedy ogłosił niepodległość Malezji 31 sierpnia 1957 roku. Rahman był pierwszym premierem niepodległej Malezji. Rządził krajem od 1957 roku do 1970 roku.\r\n\r\n	</p>\r\n\r\n\r\n', 1),
(3, 'ShanghaiTower', '\r\n	<h1>Shanghai Tower</h1>\r\n	<p class=\"txt1\">\r\n		<img class=\"img1\" src=\"https://upload.wikimedia.org/wikipedia/commons/8/8f/Shanghai_-_Shanghai_Tower_-_0003%28cropped%29.jpg\">\r\n		Shanghai Tower (chiń. 上海中心大厦; pinyin Shànghǎi Zhōngxīn Dàshà) – wieżowiec znajdujący się w dzielnicy Pudong w Szanghaju w bezpośrednim sąsiedztwie Jin Mao oraz SWFC. Budowa zaczęła się w 2008 r. jej zakończenie zaplanowano na rok 2015, ostatecznie budynek został oddany do użytku w roku 2017[1]. Inwestorem oraz wykonawcą jest Shanghai Tower Construction & Development Co., Ltd. reprezentująca trzy firmy: Shanghai Chengtou Corp., Luijiazui Finance & Trade Zone Development Co., Ltd., oraz Shanghai Construction Group. Wieżowiec zaprojektowało biuro architektoniczne Gensler. Koszt budowy wyniósł 2,4 mld $[1].\r\n		Wieżowiec jest najwyższym w Chinach oraz trzecim pod względem wysokości na świecie, niższym tylko od Burdż Chalifa w Dubaju w Zjednoczonych Emiratach Arabskich i Merdeka 118 w Kuala Lumpur w Malezji.\r\n\r\n	</p>\r\n	<h2 class=\"txt1\">Charakterystyka</h2>\r\n	<p class=\"txt1\">\r\n		<img class=\"img3\" src=\"https://upload.wikimedia.org/wikipedia/commons/3/32/Shanghai_Tower_2015.jpg\">\r\n	Bryła budynku składa się z 9 nałożonych na siebie, walcowatych budynków otoczonych podwójną fasadą. Pierwsza warstwa fasady otacza te budynki bezpośrednio się z nimi stykając, druga stanowi zewnętrzną fasadę całej budowli. Przestrzeń pomiędzy nimi wypełniona zostanie przez dziewięć atriów[2].\r\n\r\n	</p>\r\n\r\n	<p class=\"txt1\">\r\n		<img class=\"img1\" src=\"https://static2.gensler.com/uploads/hero_element/7497/thumb_desktop/thumbs/project_shanghai-tower_1024x576_08_1444153208_1024x576.jpg\">\r\n		Budynek został tak skonstruowany, aby zmniejszyć nacisk wywierany przez wiatr, umożliwić zbieranie deszczówki celem wykorzystania jej w systemach HVAC oraz umożliwić generowanie energii przez turbiny wiatrowe. Właściciele budynku ubiegają się o certyfikację China Green Building Committee oraz U.S. Green Building Council[2].\r\n\r\n	</p>\r\n\r\n	<p class=\"txt1\">\r\n		<img class=\"img3\" src=\"https://static.dezeen.com/uploads/2016/01/Shanghai-Tower_Gensler_dezeen_ban.jpg\">\r\n		Budynek ma ponad 220 tysięcy metrów kwadratowych powierzchni użytkowej. Dla porównania, łączna powierzchnia biur w Szczecinie na koniec 2016 roku wynosiła 156 tysięcy metrów kwadratowych[1].\r\n\r\n	</p>\r\n\r\n	<p class=\"txt1\">\r\n		<img class=\"img1\" src=\"https://static1.gensler.com/uploads/hero_element/7495/thumb_desktop/thumbs/shanghai-tower_1024x576_06alt_1493834968_1024x576.jpg\">\r\n		Pomieszczenia są wykorzystywane przede wszystkim przez biura, a poza nimi obiekty handlowe, rozrywkowe oraz konferencyjne. W obiekcie znajdzie się również jeden z najwyżej położonych hoteli na świecie – Shanghai Tower J Hotel firmy Jin Jiang Hotels. W jego ofercie znajdzie się 258 pokoi zlokalizowanych na piętrach 84-110. W podziemnych kondygnacjach znajduje się 3-poziomowy parking podziemny, powierzchnie handlowe oraz połączenie z metrem[3]. Na jednym z najwyższych pięter znajduje się taras widokowy[2].\r\n\r\n	</p>\r\n', 1),
(4, 'MakkahRoyalClockTower', '\r\n	\r\n	<h1>Makkah Royal Clock Tower</h1>\r\n	<p class=\"txt1\">\r\n		<img class=\"img1\" src=\"https://upload.wikimedia.org/wikipedia/en/f/f4/Abraj-al-Bait-Towers.JPG\">\r\n		Makkah Royal Clock Tower(arab. أبراج البيت, Abrāǧ al-Bayt) – kompleks hotelowy w Mekce, w Arabii Saudyjskiej, postmodernistyczny, wzniesiony w latach 2004–2011 według projektu zespołu architektów biura architektonicznego SL Rasch; znajduje się w bezpośrednim sąsiedztwie Świętego Meczetu.\r\n		Abradż al-Bajt znajduje się w pobliżu największego na świecie meczetu i najświętszego miejsca islamu, Al-Masdżid al-Haram.\r\n	</p>\r\n\r\n	<p class=\"txt1\">\r\n		<img class=\"img3\" src=\"https://images.unsplash.com/photo-1656463466195-99920b66542e?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8bWFra2FoJTIwY2xvY2slMjB0b3dlcnxlbnwwfHwwfHx8MA%3D%3D\">\r\n		Kompleks posiada kilka światowych rekordów, w tym najwyższy hotel na świecie, najwyższy zegar wieżowy na świecie, największa na świecie tarcza zegara[1], i największy na świecie budynek pod względem powierzchni.\r\n		Kompleks stał się drugim pod względem wysokości budynkiem na świecie w 2011 roku, ustępował tylko Burdż Chalifa w Dubaju. Od 2015 roku zajmuje 3. miejsce. Projektantem i wykonawcą obiektu jest Saudi Binladin Group, największa firma budowlana królestwa[2].\r\n	</p>\r\n\r\n	<p class=\"txt1\">\r\n		<img class=\"img1\" src=\"https://www.fairmont.com/assets/0/104/1965/1970/1971/b32f408d-4f87-4d6f-8e89-8b587788e9ed.jpg\">\r\n		Wieżowiec mieści najwyższy taras widokowy Arabii Saudyjskiej na wysokości 558 metrów nad poziomem gruntu. Na wyższych poziomach mieści się szereg udogodnień, np. centrum obserwacji księżycowej, muzeum kosmologii, Muzeum Islamu oraz dużą salę modlitwy, która może pomieścić ponad 10 000 osób.\r\n		W skład kompleksu wchodzi 7 budynków, symetryczne i znajdujące się w przednim rzędzie Safa Tower po lewej i Marwah Tower po prawej. Tylny rząd to odpowiednio od lewej: Maqam Tower, Hajar Tower, Mekkah Royal Clock Hotel Tower, Zamzam Tower oraz Qibla Tower.\r\n\r\n	</p>\r\n\r\n	<p class=\"txt1\">\r\n		<img class=\"img3\" src=\"https://images.pexels.com/photos/12052403/pexels-photo-12052403.jpeg?cs=srgb&dl=pexels-abdulaziz-asiri-220481192-12052403.jpg&fm=jpg\">\r\n		Oprócz 858 pokoi hotelowych, budynek mieści także 9 pięciogwiazdkowych restauracji oferujących szeroki wybór kuchni, w tym azjatycką, śródziemnomorską i saudyjską. Znajduje się tutaj także sala balowa mogąca pomieścić do 700 osób oraz sale konferencyjne na łącznie ponad 1500 osób. Na dwóch mniejszych budynkach znajdują się lądowiska dla helikopterów.\r\n\r\n	</p>\r\n\r\n	<p class=\"txt1\">\r\n		<img class=\"img1\" src=\"https://www.sl-rasch.com/wp-content/uploads/2019/07/Turm_Uhr_Header.jpg\">\r\n		Wieża zegarowa w Mekce jest najwyższą wieżą zegarową na świecie. Godzinę pokazywaną przez zegar można ponoć odczytać z odległości 17 kilometrów. To wszystko za sprawą największego na świecie zegara o tarczy mierzącej 43 metry oraz wskazówce minutowej mającej 23 metry długości. Tarcza zegara jest 35 razy większa niż te w londyńskim Big Benie.\r\n\r\n	</p>\r\n\r\n\r\n', 1),
(5, 'Kontakt', '\r\n\r\n\r\n	<h2 class=\"span\"></h2>\r\n\r\n\r\n	<div class=\"content\">\r\n        <form action=\"mailto:your-email@example.com\" method=\"post\" enctype=\"text/plain\">\r\n            <label for=\"name\">Imię:</label>\r\n            <input type=\"text\" id=\"name\" name=\"name\">\r\n\r\n            <label for=\"email\">E-mail:</label>\r\n            <input type=\"email\" id=\"email\" name=\"email\">\r\n\r\n            <label for=\"message\">Wiadomość:</label>\r\n            <textarea id=\"message\" name=\"message\"></textarea>\r\n\r\n            <input type=\"submit\" value=\"Wyślij\">\r\n        </form>\r\n    </div>\r\n\r\n\r\n\r\n', 1),
(6, 'filmy', '\r\n\r\n\r\n<h2>Filmy związane z tematyką</h2>\r\n<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/watch?v=lflCmjW7RlI&ab_channel=theLuxuryTravelExpert\" frameborder=\"0\" allowfullscreen></iframe>\r\n<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/watch?v=WahnpK79p9w&ab_channel=Driftershoots\" frameborder=\"0\" allowfullscreen></iframe>\r\n<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/watch?v=JgkgBZfLu2I&ab_channel=TheB1M\" frameborder=\"0\" allowfullscreen></iframe>\r\n\r\n\r\n\r\n', 1),
(7, 'StronaG', '\r\n\r\n\r\n\r\n	<h1>Ta strona zawiera informacje o 4 najwyższych budynkach na całym świecie, oraz formularz kontaktowy, a więc podstrony takie jak:</h1>\r\n	<p class=\"txt1\">\r\n		<img class=\"img1\" src=\"https://www.allplan.com/fileadmin/_processed_/6/5/csm_iStock-183346577_NEU_b998568fdd.jpg\">\r\n		<h2 class=\"txt2\">Burj Khalifa</h2>\r\n	</p>\r\n\r\n	<p class=\"txt1\">\r\n		<img class=\"img3\" src=\"https://constructalia.arcelormittal.com/files/Meredeka+118-1_web--4d1379b5f2266abdc76118977a424df3.jpg\">\r\n		<h2 class=\"txt3\">Merdeka 118</h2>\r\n	</p>\r\n\r\n	<p class=\"txt1\">\r\n		<img class=\"img1\" src=\"https://static2.gensler.com/uploads/hero_element/7497/thumb_desktop/thumbs/project_shanghai-tower_1024x576_08_1444153208_1024x576.jpg\">\r\n		<h2 class=\"txt2\">Shanghai Tower</h2>\r\n	</p>\r\n\r\n	<p class=\"txt1\">\r\n		<img class=\"img3\" src=\"https://www.worldconstructionnetwork.com/wp-content/uploads/sites/26/2020/01/Image-1-Makkah-Royal-Clock-Tower-Saudi-Arabia.jpg\">\r\n		<h2 class=\"txt3\">Makkah Royal Clock Tower</h2>\r\n	</p>\r\n\r\n	<p class=\"txt1\">\r\n		<img class=\"img1\" src=\"https://tbs.sierpc.pl/wp-content/uploads/2013/08/kontakt.jpg\">\r\n		<h2 class=\"txt2\">Kontakt</h2>\r\n	</p>\r\n\r\n\r\n\r\n\r\n\r\n', 1);

-- --------------------------------------------------------

--
-- Структура таблиці `produkty`
--

CREATE TABLE `produkty` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tytul` varchar(255) NOT NULL,
  `opis` text NOT NULL,
  `data_utworzenia` date NOT NULL,
  `data_modyfikacji` date NOT NULL,
  `data_wygasniecia` date NOT NULL,
  `cena_netto` double NOT NULL,
  `podatek_vat` double NOT NULL,
  `sztuk_w_magazynie` int(11) NOT NULL,
  `status_dostepnosci` tinyint(1) NOT NULL,
  `kategoria` bigint(20) UNSIGNED NOT NULL,
  `gabaryt_produktu` varchar(255) NOT NULL,
  `zdjecie` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `produkty`
--

INSERT INTO `produkty` (`id`, `tytul`, `opis`, `data_utworzenia`, `data_modyfikacji`, `data_wygasniecia`, `cena_netto`, `podatek_vat`, `sztuk_w_magazynie`, `status_dostepnosci`, `kategoria`, `gabaryt_produktu`, `zdjecie`) VALUES
(10, 'Iphone 9', 'Apple iPhone 9 zapowiada się naprawdę obiecująco, lecz z pewnością nie trafi w gusta wszystkich użytkowników. Oto najważniejsze cechy, na jakie należy zwrócić uwagę podczas zakupów.', '2024-12-15', '2025-01-06', '2032-12-26', 1999, 2, 40, 1, 2, 'Mały', 'img/iphone-9-cena.jpg'),
(16, ' Apple MacBook Pro 16', 'MacBook Pro 16 cali z czipem M4 Pro lub M4 Max to potężny laptop o jeszcze większej wydajności. Dzięki baterii nawet na 24 godziny1 i zjawiskowemu wyświetlaczowi Liquid Retina XDR o jasności szczytowej 1600 nitów to sprzęt pro pod każdym względem.', '2024-12-15', '2025-01-06', '2035-12-29', 26499, 5, 20, 1, 3, 'Mały', 'img/Screenshot_12.png'),
(17, 'Laptop LENOVO IdeaPad Slim 3', 'Laptop LENOVO z ekranem o przekątnej 14 cali i rozdzielczości 1920 x 1080 pikseli, wyposażony w procesor MediaTek Kompanio 520 o częstotliwości 2.0 GHz, pamięć RAM LPDDR4X o wielkości 8 GB. Dysk twardy eMMC o pojemności 128 GB. Karta graficzna ARM Mali-G52 2EE MC2. Zainstalowany system operacyjny to Chrome OS.', '2024-12-15', '2024-12-15', '2034-12-16', 999, 6, 0, 0, 3, 'Mały', 'img/Laptop-LENOVO-IdeaPad-Slim-3-01-front.jpg');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `kategorki`
--
ALTER TABLE `kategorki`
  ADD UNIQUE KEY `id` (`id`);

--
-- Індекси таблиці `page_list`
--
ALTER TABLE `page_list`
  ADD UNIQUE KEY `id` (`id`);

--
-- Індекси таблиці `produkty`
--
ALTER TABLE `produkty`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `FK_PRODUCTKAT` (`kategoria`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `kategorki`
--
ALTER TABLE `kategorki`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT для таблиці `page_list`
--
ALTER TABLE `page_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT для таблиці `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `produkty`
--
ALTER TABLE `produkty`
  ADD CONSTRAINT `FK_PRODUCTKAT` FOREIGN KEY (`kategoria`) REFERENCES `kategorki` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
