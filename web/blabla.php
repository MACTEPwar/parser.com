<?php
use yii\helpers\Html;

require_once ('simple_html_dom.php');
function func($curent_item, &$m_table)
{
//    if ($curent_item > 500) {
//        return;
//        
//    }
    $opts = array(
        'http'=>array(
            'header' => "User-Agent:MyAgent/1.0\r\n",
            'verify_peer' => false,
            ),
        'ssl' => array(
                    'verify_peer'      => false,
                    'verify_peer_name' => false,
                    )
        );
    $context = stream_context_create($opts);
    $site = file_get_contents('http://www.globalsources.com/gsol/GeneralManager?supplier_search=on&query=**&loc=t&type=new&point_search=on&product_search=off&qType=SUPPLIER&suppNo='.$curent_item.'&page=search%2FSupplierSearchResults&article_search=off&action=GetPoint&action=DoFreeTextSearch&AGG=N&language=en&point_id=3000000149681&catalog_id=2000000003844',false,$context);
    $html = file_get_html_my('http://www.globalsources.com/gsol/GeneralManager?supplier_search=on&query=**&loc=t&type=new&point_search=on&product_search=off&qType=SUPPLIER&suppNo='.$curent_item.'&page=search%2FSupplierSearchResults&article_search=off&action=GetPoint&action=DoFreeTextSearch&AGG=N&language=en&point_id=3000000149681&catalog_id=2000000003844',$site);
    $items = $html->find('.supplierUSP p a');
    for ($i=0;$i<count($items);$i+=2)
    {
        sleep(1);
        if ($i>38) break; //38 - all for one page
        $link = substr($items[$i]->href, 0,strrpos($items[$i]->href,'/',0)).'/CompanyProfile';
        $myopts = array(
        'http'=>array(
            'header' => "User-Agent:MyAgent/1.0\r\n",
            'verify_peer' => false,
            ),
        'ssl' => array(
                    'verify_peer'      => false,
                    'verify_peer_name' => false,
                    )
        );
        $mycontext = stream_context_create($myopts);
        $mysite = file_get_contents($link,false,$mycontext);
        $html_2 = file_get_html_my($link,$mysite);
        $items_2 = $html_2->find('em.fl');
        $items_3 = $html_2->find('.spCompanyInfo',0)->children(0); //Company name
        $items_4 = $html_2->find('div.spCompanyInfo p');
        $items_5 = $html_2->find('div.mt20 div.proDetCont');
        //echo '<tr>';
        $temp_mass = array('CompanyName'=>$items_3->plaintext);
        for ($j=0;$j<count($items_2);$j++)
        {
            $str = $m_table[0][$j+1].':';
            $str2 = str_replace(" ","",$items_2[$j]->plaintext);
            if ($str2 == $str)
            {
                if (str_replace(" ","",$items_2[$j]->next_sibling()->plaintext)=="")
                {
                    $temp_mass[$m_table[0][$j+1]] = str_replace(stristr(str_replace(" ","",str_replace(chr(9),"",$items_4[$j]->plaintext)), '&nbsp;(',true),"",str_replace(" ","",str_replace(chr(9),"",$items_4[$j]->plaintext)));
                }
                else
                {
                    $temp_mass[$m_table[0][$j+1]] = str_replace(" ","",$items_2[$j]->next_sibling()->plaintext);
                }
            }
            else 
            {
                for ($l=0;$l<count($m_table[0]);$l++)
                {
                    if ($str2 == $m_table[0][$l+1].':')
                    {
                        if ($items_2[$j]->next_sibling()!=null)
                        {
                            $temp_mass[$m_table[0][$l+1]] = $items_2[$j]->next_sibling()->plaintext;
                        }
                        else
                        {
                            $pos = stripos($items_2[$j]->parent()->plaintext,':');
                            $temp_mass[$m_table[0][$l+1]] = mb_substr($items_2[$j]->parent()->plaintext,$pos+1);
                        }
                    }
                }
            }
        }
        for ($co = 0;$co<count($m_table[0]);$co++)
        {
            for ($r = 0 ; $r<count($items_5);$r++)
            {
                if ($m_table[0][$co].':' ==  str_replace(" ","",$items_5[$r]->children[0]->plaintext))
                {
                    $temp_mass[$m_table[0][$co]] = $items_5[$r]->children[1]->plaintext;
                }
            }
        }
        if ($m_table[count($m_table)]['CompanyName'] != $temp_mass['CompanyName'])
        {
            $m_table[]=$temp_mass;
        }
    }
    //$curent_item+=20;
    //func($curent_item,$m_table);
}
?>
        <?php
        $data_mass = array($_POST['arr']);
        //for ($la = 0; $la<=40;$la+=20)
//        $data_mass = array($_POST['arr'],
//                array('1','1Address','1Tel','1Fax','1Mobile','1HomepageAddress','1E-mail','1OtherHomepageAddress'),
//                array('2','2Address','2Tel','2Fax','2Mobile','2HomepageAddress','2E-mail','2OtherHomepageAddress'));
        {
            func($_POST['curent_ind'],$data_mass);
        }
        echo json_encode(array('mass'=>$data_mass));
        ?>
        <?php
//        for ($i=0;$i<count($data_mass);$i++)
//        {
//            echo '<tr>';
//            for ($j=0;$j<count($data_mass[0]);$j++)
//            {
//                if ($i==0)
//                {
//                    echo '<th>'.$data_mass[$i][$j].'</th>';
//                }
//                else
//                {
//                    echo '<td>'.$data_mass[$i][$data_mass[0][$j]].'</td>';
//                }
//            }
//            echo '</tr>';
//        }
        ?>
