<?php


class RSSParser {

	var $insideitem = false;
	var $tag = "";
	var $title = "";
	var $description = "";
	var $link = "";

	function startElement($parser, $tagName, $attrs) {
		if ($this->insideitem) {
			$this->tag = $tagName;
		} elseif ($tagName == "ITEM") {
			$this->insideitem = true;
		}
	}

	function endElement($parser, $tagName) {
		if ($tagName == "ITEM") {
			 // printf("<dt><b><a href='%s'>%s</a></b></dt>",
			// 	trim($this->link),htmlspecialchars(trim($this->title)));
			// printf("<dd>%s</dd>",htmlspecialchars(trim($this->description)));
			printf("\n<div class=\"rssitem\">");

			printf("\n<h3><a href='%s'>%s</a></h3>",
			 	trim($this->link),trim($this->title));
			printf("\n<div>%s</div>",trim($this->description));
			$this->title = "";
			$this->description = "";
			$this->link = "";
			$this->insideitem = false;
			printf("\n</div>\n");
		}
	}

	function characterData($parser, $data) {
		if ($this->insideitem) {
		switch ($this->tag) {
			case "TITLE":
			$this->title .= $data;
			break;
			case "DESCRIPTION":
			$this->description .= $data;
			break;
			case "LINK":
			$this->link .= $data;
			break;
		}
		}
	}
}


function displayRss($url)
{
	$xml_parser = xml_parser_create();
	$rss_parser = new RSSParser();
	xml_set_object($xml_parser,$rss_parser);
	xml_set_element_handler($xml_parser, "startElement", "endElement");
	xml_set_character_data_handler($xml_parser, "characterData");
	$fp = fopen($url,"r")
		or die("Error reading RSS data from " . $url);
	while ($data = fread($fp, 4096))
		xml_parse($xml_parser, $data, feof($fp))
			or die(sprintf("XML error: %s at line %d", 
				xml_error_string(xml_get_error_code($xml_parser)), 
				xml_get_current_line_number($xml_parser)));
	fclose($fp);
	xml_parser_free($xml_parser);
}

?>
