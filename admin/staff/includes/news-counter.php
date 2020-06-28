<?php
include'connect.php';
 		$general_news = "SELECT * FROM news WHERE news_category='General News'";
 		$general_news_query = mysqli_query($conn, $general_news);
 		$general_news_counter = mysqli_num_rows($general_news_query);

 		$pensa_news = "SELECT * FROM news WHERE news_category='PENSA'";
 		$pensa_news_query = mysqli_query($conn, $pensa_news);
 		$pensa_news_counter = mysqli_num_rows($pensa_news_query);

 		$news_article = "SELECT * FROM news WHERE news_category='Articles'";
 		$news_article_query = mysqli_query($conn, $news_article);
 		$news_article_counter = mysqli_num_rows($news_article_query);

 		$church_news = "SELECT * FROM news WHERE news_category='Church News'";
 		$church_news_query = mysqli_query($conn, $church_news);
 		$church_news_counter = mysqli_num_rows($church_news_query);


 		$other_news = "SELECT * FROM news WHERE news_category='Other News'";
 		$other_news_query = mysqli_query($conn, $other_news);
 		$other_news_counter = mysqli_num_rows($other_news_query);
 		?>