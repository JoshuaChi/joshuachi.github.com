<?php

$link = mysql_connect('localhost', 'root', 'root');
if (!$link) {
	    die('Could not connect: ' . mysql_error());
}

mysql_select_db("freetofeel");
$query = "select post_title, post_name, post_date, post_content, post_excerpt, ID, guid from wp_posts where post_status = 'publish' and post_type = 'post'";
mysql_query("SET NAMES 'utf8'", $link);
$result = mysql_query($query, $link);

while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	$title = '"'.str_replace(array("'", "\""), "", $row[0]).'"';
	$slug = $row[1];
	$date = $row[2];
	$content = $row[3];
  $excerpt = $row[4];
  $id = $row[5];
	$guid = $row[6];
	$name = date('Y-m-d',strtotime($date)).'-'.$slug.'.markdown';
	$body = "---\nlayout: post\ntitle: ".$title."\n---\n\n"."<p class='meta'>".$date."</p>\n\n".$content;
echo $title."\n\n";
	$file = fopen($name, 'w+');
	fputs($file, $body);
	fclose($file);
}

      //def self.process(dbname, user, pass, host)
      //db = Sequel.mysql(dbname, :user => user, :password => pass, :host => host)
      //#db = Sequel.connect(:adapter => 'mysql', :database=>dbname, :user => user, :password => pass, :host => host)
      //#db = Sequel.connect('mysql://localhost/freetofeel?user=root&password=root')

      //FileUtils.mkdir_p "_posts"

      //db[QUERY].each do |post|
      //#db['wp_posts'].each do |post|
        //# Get required fields and construct Jekyll compatible name
        //title = post[:post_title]
        //slug = post[:post_name]
        //date = post[:post_date]
        //content = post[:post_content]
        //name = "%02d-%02d-%02d-%s.markdown" % [date.year, date.month, date.day,
                                               //slug]

        //# Get the relevant fields as a hash, delete empty fields and convert
        //# to YAML for the header
        //data = {
           //'layout' => 'post',
           //'title' => title.to_s,
           //'excerpt' => post[:post_excerpt].to_s,
           //'wordpress_id' => post[:ID],
           //'wordpress_url' => post[:guid]
         //}.delete_if { |k,v| v.nil? || v == ''}.to_yaml

        //# Write out the data and content to file
        //File.open("_posts/#{name}", "w") do |f|
          //f.puts data
          //f.puts "---"
          //f.puts content
					//end



mysql_close($link);
