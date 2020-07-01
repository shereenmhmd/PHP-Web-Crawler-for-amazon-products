<select>  
    
      <?php

          $i=1;
          while ($i<=10) //this shows first 10 pages, it should be number of pages 400
          {

           $url = 'https://www.amazon.com/s?k=laptop&i=computers-intl-ship&s=price-asc-rank&page='.$i.'&qid=1593460799&ref=sr_pg_'.$i;
            $html= file_get_contents($url);

            $dom = new DOMDocument();
            @$dom->loadHTML($html);

            $xPath = new DOMXPath($dom);
            $classname="a-size-medium a-color-base a-text-normal";
            $elements = $xPath->query("//*[contains(@class, '$classname')]");

            foreach ($elements as $e){

              $text = substr($e->nodeValue, 0,40);
                ?>
                <option value="<?php echo $e->nodeValue;?>"><?php echo $text;?></option>
                 
                <?php
                $lnk = $e->getAttribute('href');
                $e->setAttribute("href", "http://www.amazon.in".$lnk);
                $newdoc = new DOMDocument;
                $e = $newdoc->importNode($e, true);
                $newdoc->appendChild($e);
                $html = $newdoc->saveHTML();
            }

            $i++;

           }
          ?>
        </select> 