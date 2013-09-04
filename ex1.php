<?php 
	
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);	
	// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Проект дачного дома 4х5 м (базовая комплектация)');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
//$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
$html = <<<EOD
<h2>TEST</h2>
<div class="plate bcBack">

                    <div class="sect">

                        <h3>Проект дачного дома 4х5 м (базовая комплектация).</h3>

	                    		                    		                    <img src="http://nwst.ru/shared/files/pro1_56.jpg">
	                    
	                    <div class="meta">

		                    			                    <div class="aside">
				                    <span>Цены:</span>
				                    <dl class="price">

						                							                <dt>из профилированного бруса 140х140 мм</dt>
							                <dd>302&nbsp;560&nbsp;р.</dd>
						                							                <dt>из профилированного бруса 90х140 мм</dt>
							                <dd>292&nbsp;220&nbsp;р.</dd>
						                				                    </dl>
			                    </div>
		                    
		                    <table>
<tbody>
<tr>
<td>Размер дома:</td>
<td>4,0х5,0 м</td>
</tr>
<tr>
<td>S застройки:</td>
<td>20,0 м<sup>2</sup></td>
</tr>
<tr>
<td>Материал:</td>
<td>проф. брус</td>
</tr>
<tr>
<td>1 этаж:&nbsp;</td>
<td>20,0 м<sup>2</sup></td>
</tr>
<tr>
<td>Мансарда:&nbsp;</td>
<td>10,4 м<sup>2</sup></td>
</tr>
</tbody>
</table>
		                    <div style="clear: both"></div>

		                    			                    <p style="text-align: right">
				                    <a href="/upload/file/print_proekt/dom_5x4_base.pdf"><img src="/upload/image/print.jpg" width="20" height="20">&nbsp;<span style="color: #808080;">версия для печати</span></a>
			                    </p>
		                    
	                    </div>
	                    <hr>

                        <p><span><strong><span style="color: #006699">Фотографии:</span></strong></span></p>
                                                                        <div class="galblock_alt">
                                                        <a class="gallery" rel="galblock1" title="Проект дачного дома 4х5 м (базовая комплектация СК СтройТехнологии)" href="http://nwst.ru/shared/files/pro1_56.jpg">
                                <img src="http://nwst.ru/shared/files/s_pro1_56.jpg" alt="Проект дачного дома 4х5 м (базовая комплектация СК СтройТехнологии)">
                            </a>
                                                        <a class="gallery" rel="galblock1" title="Проект дачного дома 4х5 м (базовая комплектация СК СтройТехнологии)" href="http://nwst.ru/shared/files/pro2_56.jpg">
                                <img src="http://nwst.ru/shared/files/s_pro2_56.jpg" alt="Проект дачного дома 4х5 м (базовая комплектация СК СтройТехнологии)">
                            </a>
                                                        <a class="gallery" rel="galblock1" title="Проект дачного дома 4х5 м (базовая комплектация СК СтройТехнологии)" href="http://nwst.ru/shared/files/pro3_56.jpg">
                                <img src="http://nwst.ru/shared/files/s_pro3_56.jpg" alt="Проект дачного дома 4х5 м (базовая комплектация СК СтройТехнологии)">
                            </a>
                                                        <a class="gallery" rel="galblock1" title="Проект дачного дома 4х5 м (базовая комплектация СК СтройТехнологии)" href="http://nwst.ru/shared/files/pro_p1_56.jpg">
                                <img src="http://nwst.ru/shared/files/s_pro_p1_56.jpg" alt="Проект дачного дома 4х5 м (базовая комплектация СК СтройТехнологии)">
                            </a>
                                                        <a class="gallery" rel="galblock1" title="Проект дачного дома 4х5 м (базовая комплектация СК СтройТехнологии)" href="http://nwst.ru/shared/files/pro_p2_56.jpg">
                                <img src="http://nwst.ru/shared/files/s_pro_p2_56.jpg" alt="Проект дачного дома 4х5 м (базовая комплектация СК СтройТехнологии)">
                            </a>
                                                        <a class="gallery" rel="galblock1" title="Проект дачного дома 4х5 м (базовая комплектация СК СтройТехнологии)" href="http://nwst.ru/shared/files/pro_p3_56.jpg">
                                <img src="http://nwst.ru/shared/files/s_pro_p3_56.jpg" alt="Проект дачного дома 4х5 м (базовая комплектация СК СтройТехнологии)">
                            </a>
                                                        <a class="gallery" rel="galblock1" title="Проект дачного дома 4х5 м (базовая комплектация СК СтройТехнологии)" href="http://nwst.ru/shared/files/pro_f1_56.jpg">
                                <img src="http://nwst.ru/shared/files/s_pro_f1_56.jpg" alt="Проект дачного дома 4х5 м (базовая комплектация СК СтройТехнологии)">
                            </a>
                                                        <a class="gallery" rel="galblock1" title="Проект дачного дома 4х5 м (базовая комплектация СК СтройТехнологии)" href="http://nwst.ru/shared/files/pro_f2_56.jpg">
                                <img src="http://nwst.ru/shared/files/s_pro_f2_56.jpg" alt="Проект дачного дома 4х5 м (базовая комплектация СК СтройТехнологии)">
                            </a>
                                                        <a class="gallery" rel="galblock1" title="Проект дачного дома 4х5 м (базовая комплектация СК СтройТехнологии)" href="http://nwst.ru/shared/files/pro_f3_56.jpg">
                                <img src="http://nwst.ru/shared/files/s_pro_f3_56.jpg" alt="Проект дачного дома 4х5 м (базовая комплектация СК СтройТехнологии)">
                            </a>
                                                        <a class="gallery" rel="galblock1" title="Проект дачного дома 4х5 м (базовая комплектация СК СтройТехнологии)" href="http://nwst.ru/shared/files/pro_f4_56.jpg">
                                <img src="http://nwst.ru/shared/files/s_pro_f4_56.jpg" alt="Проект дачного дома 4х5 м (базовая комплектация СК СтройТехнологии)">
                            </a>
                                                    </div>
                                                	                    <p style="text-align: left;"><strong style="color: #006699;"><em>Брусовой дачный дом 4,0x5,0&nbsp;м&nbsp;с мансардой</em></strong></p><p><span style="color: #808080;"><strong>Комплектация брусового дома:</strong></span></p><p><span style="color: #006699;"><strong>Сруб:</strong></span></p>
                                                	                     </div>
                </div>
EOD;

// Print text using writeHTMLCell()
//echo "TAKE1 "; 
//echo $pdf->getNumPages(); 

@$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

//echo "TAKE2 "; 
//echo $pdf->getNumPages(); 

$pdf->AddPage(); 

$zml = <<<EOD
<ul>
<li><span>капитальные стены: <a href="/materials/">строганный профилированный брус</a> (сечение бруса на выбор:&nbsp;90x140 мм, 140x140 мм)</span></li>
<li><span>перегородки: строганный профилированный брус (сечение бруса на выбор: 90x140 мм, 140x140 мм)</span></li>
<li><span>межвенцовый утеплитель: <a href="/materials/uteplitel/djut/">льноджутовое полотно</a></span></li>
<li><span>рубка углов: в шип «теплый угол»</span></li>
</ul><p><span><strong><span style="color: #006699;">Утепление:</span></strong></span></p><ul>
<li><span>пол 1 этаж: утеплитель <a href="/materials/uteplitel/isover/">ISOVER KT-40</a> 100 мм (возможна замена на <a href="/materials/uteplitel/">утеплители</a> большей плотности и (или) толщины по желанию Заказчика)</span></li>
<li><span>потолок 1 этаж: утеплитель ISOVER KT-40 100 мм (возможна замена на утеплители большей плотности и (или) толщины по желанию Заказчика)</span></li>
<li><span>мансардный этаж: -</span></li>
</ul><p><span style="color: #006699;"><strong>Отделка:</strong></span></p><ul>
<li><span>потолок 1-го этажа дома: хвойная <a href="/materials/vagonka/">вагонка</a> принудительной сушки категории В, хвойный плинтус</span>&nbsp;</li>
<li><span>фронтоны: вагонка принудительной сушки категории В по каркасу (возможно изготовление из профилированного бруса или замена на альтернативные материалы)</span></li>
<li><span>мансардный этаж:&nbsp;-</span></li>
</ul><p><span style="color: #006699;"><strong>Основание и полы:</strong></span></p><ul>
<li><span>нижняя обвязка дома: пиленый брус минимальным сечением 150x150 мм</span></li>
<li><span>половые и потолочные балки: пиленый брус сечением не менее 100х150 мм</span></li>
<li><span>черновой пол: хвойная обрезная доска 20 мм</span></li>
<li><span>ветроизоляция пола первого этажа: <a href="/materials/ondutis/ondutis-R100/">Ondutis R100</a> или аналог</span></li>
<li><span>чистовой пол: хвойная шпунтованная доска принудительной сушки не менее 28 мм на первом этаже и на мансарде.</span>&nbsp;</li>
</ul><p><span><strong><span style="color: #006699;">Высоты помещений:</span></strong> </span></p><ul>
<li><span>1-й этаж – 2,3 м (высота может быть изменена по желанию Заказчика)</span></li>
<li><span>мансардный этаж&nbsp;– 2,2 м (высота может быть изменена по желанию Заказчика)</span></li>
</ul><p><span style="color: #006699;"><strong>Лестница:</strong></span></p><ul>
<li><span><a href="/materials/ladder/">деревянная, ширина 80 см</a>, в комплекте устанавливаются стартовые столбы, балясины и перила </span></li>
</ul><p><span><strong><span style="color: #006699;">Кровля:</span></strong></span></p><ul>
<li><span>стропильная система: доска сечением не менее 40х150 мм</span></li>
<li><span>обрешетка кровли: доска 20 мм, шаг 200 мм (если используется <a href="/materials/krovelnye-raboty/">кровельный материал отличный</a> от <a href="/materials/roof/Onduline/">Ондулина</a>, обрешетка кровли может быть изменена)</span></li>
<li><span>подкровельная мембрана: <a href="/materials/ondutis/ondutis-a120/">Ondutis A120</a> или аналог</span></li>
<li><span>материал кровли: <a href="/materials/roof/Onduline/">Ondulin</a> (материал и цвет кровельного покрытия может быть изменен по желанию Заказчика)</span></li>
<li><span>ширина свесов кровли: не менее 400 мм</span></li>
<li><span><a href="/materials/kryshi/">тип кровли</a>: согласно проекту</span></li>
</ul><p><span style="color: #006699;"><strong>Окна:</strong></span></p><ul>
<li><span><a href="/materials/windows/">деревянный оконный блок производства СтройТехнологии</a> с двойным остеклением и силиконовым уплотнителем (возможна замена на <a href="/materials/okna-rehau/">металлопластиковые окна Rehau</a>)</span></li>
<li><span>количество окон согласно проекту</span></li>
<li><span>деревянные наличники</span></li>
</ul><p><span style="color: #006699;"><strong>Двери:</strong></span></p><ul>
<li><span>входная: 860 (960)х2050 мм <a href="/materials/doors/">металлическая утепленная с порошковой окраской</a> и внутренней ламинацией имитирующей ценные породы древесины</span>&nbsp;</li>
<li><span>комплект межкомнатных дверей: деревянные филенчатые производства СтройТехнологии</span></li>
<li><span>количество дверей согласно проекту</span></li>
<li><span>наличники</span></li>
</ul><p><span><strong><span style="color: #006699;">Доставка и сборка:</span></strong></span></p><ul>
<li>&nbsp;<span><span>входят в стоимость дома по выбранному Вами проекту (<a href="/news/115.html">подробнее о доставке</a>)</span></span></li>
</ul><p>&nbsp;<span style="color: #006699;"><strong>Оплата:</strong></span></p><ul>
<li><span>30% при заключении Договора, 70% после сдачи объекта</span></li>
<li><span><a href="/prices/insur/">страховка построенного дома</a> на 1 год В ПОДАРОК!</span></li>
</ul><hr><p><em><strong>По выбранному Вами проекту мы можем построить:</strong></em></p><ul>
<li><em>сруб дома&nbsp;из пиленого бруса</em></li>
<li><em>дом из <a href="/materials/">профилированного бруса</a> принудительной сушки, максимальное сечение бруса 140x140 мм</em></li>
<li><em>дом или домокомплект из клееного бруса</em></li>
<li><em>сруб дома из окоренного или строганного <a href="/woodhouses/srub/">бревна</a></em></li>
<li><em><a href="/woodhouses/sruby-iz-brusa/">сруб дома&nbsp;из профилированного бруса</a> принудительной сушки или естественной влажности</em></li>
</ul><p><strong><em>В доме Вы можете изменить:</em></strong></p><ul>
<li><em>планы помещений 1-го этажа и мансарды</em></li>
<li><em>высоты помещений дома</em></li>
</ul><p><strong><em>Также мы можем предложить:</em></strong></p><ul>
<li><em>помощь в <a href="/other_service/lawyer/">оформлении земельных участков в собственность</a></em></li>
<li><em>изготовление <a href="/fund/">фундамента</a> для дома (<a href="/fund/svai/">свайно-винтовой Фундамент</a>, <a href="/fund/lenta/">ленточный, ж\\б плита</a>)</em></li>
<li><em>пристройки к&nbsp;дому:&nbsp;крыльцо, веранда,&nbsp;терраса и т.п.</em></li>
<li><em>монтаж <a href="/other_service/septik/">локальной канализации</a>&nbsp;(ЛОС)</em></li>
<li><em>установку и подключение сантехники в загородном доме или коттедже</em></li>
<li><em>установку мансардных окон <a href="/materials/okna-mansardnye/Fakro/">Fakro</a>, <a href="/materials/okna-mansardnye/velux/">Velux</a></em></li>
<li><em>монтаж <a href="/materials/vodostok/">водосточной системы</a></em></li>
<li><em>установку <a href="/other_service/pechnik/">печи или камина</a></em></li>
<li><em>установку комплекта <a href="/other_service/tricolor/">спутникового телевидения</a> для Вашего загородного дома</em></li>
<li><em><a href="/other_service/electric/">электромонтажные</a> работы&nbsp;в дачных домах и коттеджах&nbsp;(в т.ч. <a href="/other_service/soglasovanie/">проектирование и согласование систем электроснабжения</a>)</em></li>
<li><em>монтаж <a href="/materials/decking/">декинга</a>&nbsp;на террасе, крыльце</em></li>
</ul>                  
EOD;

@$pdf->writeHTMLCell(0, 0, '', '', $zml, 0, 1, 0, true, '', true);
// ---------------------------------------------------------
//echo "TAKE3 "; 
//echo $pdf->getNumPages(); 
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I'); 