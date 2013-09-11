Step 1
	Collect all categories and permanent links 

Step 2 
	Visit each category url and make a "brands " array 

Step 3 
	http://elitehifi.spb.ru/katalog/{category}}/{brand}}/ 		First page 
	http://elitehifi.spb.ru/katalog/{category}}/{brand}}/?p={N} 	Other pages if availible 







categories = document.getElementsByClassName('categories').item().children; 

function ls_categories(categories){
	for(i in categories){

		try {
			title = categories[i].children[0].text; 
			link  = categories[i].children[0].href;
			entry = {title: title, href: link} 
			console.log(entry)
		} catch(e){
			console.log(e); 
		}

	}
}

// This one works fine 
function ls_categories(categories){
	for(i in categories){
		if(typeof(categories[i]) == 'object'){
			title = categories[i].children[0].text; 
			link  = categories[i].children[0].href;
			entry = {title: title, href: link} 
			console.log(entry)
		}
			
	}
}


categories = [
	{title: "СПЕЦИАЛЬНЫЕ ПРЕДЛОЖЕНИЯ", href: "http://elitehifi.spb.ru/katalog/special_nye_predlozheniya/"},
	{title: "Акустические системы", href: "http://elitehifi.spb.ru/katalog/akusticheskie_sistemy/"},
	{title: "Винил", href: "http://elitehifi.spb.ru/katalog/vinil/"},
	{title: "Инсталляционное оборудование", href: "http://elitehifi.spb.ru/katalog/installyacionnoe_oborudovanie/"},
	{title: "Кабельная продукция", href: "http://elitehifi.spb.ru/katalog/kabelnaya_produkciya/"},
	{title: "Караоке машины", href: "http://elitehifi.spb.ru/katalog/karaoke_mashiny/"},
	{title: "Комплекты Домашнего Кинотеатра", href: "http://elitehifi.spb.ru/katalog/komplekty_domashnego_kinoteatra/"},
	{title: "Кронштейны и Крепежи", href: "http://elitehifi.spb.ru/katalog/kronshtejny_i_krepezhi/"},
	{title: "Мебель для AV техники", href: "http://elitehifi.spb.ru/katalog/mebel_dlya_av_tehniki/"},
	{title: "Медиаплееры Dune", href: "http://elitehifi.spb.ru/katalog/mediapleery_dune/"},
	{title: "Минисистемы", href: "http://elitehifi.spb.ru/katalog/minisistemy/"},
	{title: "Мультирум", href: "http://elitehifi.spb.ru/katalog/multiroom/"},
	{title: "Наушники", href: "http://elitehifi.spb.ru/katalog/naushniki/"},
	{title: "Проекторы", href: "http://elitehifi.spb.ru/katalog/proektory/"},
	{title: "Проигрыватели Blu-ray и DVD", href: "http://elitehifi.spb.ru/katalog/proigryvateli_blu-ray_i_dvd/"},
	{title: "Проигрыватели CD/SACD", href: "http://elitehifi.spb.ru/katalog/proigryvateli_cd_sacd/"},
	{title: "Проигрыватели сетевые", href: "http://elitehifi.spb.ru/katalog/proigryvateli_setevye/"},
	{title: "Пульты Универсальные", href: "http://elitehifi.spb.ru/katalog/pul_ty_universal_nye/"},
	{title: "Ресиверы AV", href: "http://elitehifi.spb.ru/katalog/resivery_av/"},
	{title: "CD/DVD/Blu-ray - Ресиверы", href: "http://elitehifi.spb.ru/katalog/cddvdblu-ray_-_resivery/"},
	{title: "Сетевые Фильтры", href: "http://elitehifi.spb.ru/katalog/setevye_filtry/"},
	{title: "Телевизоры", href: "http://elitehifi.spb.ru/katalog/televizory/"},
	{title: "Телевизоры для ванной, Влагозащищенные", href: "http://elitehifi.spb.ru/katalog/televizory_dlya_vannoj_vlagozawiwennye/"},
	{title: "Тюнеры FM/AM", href: "http://elitehifi.spb.ru/katalog/tyunery_fm_am/"},
	{title: "Усилители/Ресиверы Стерео", href: "http://elitehifi.spb.ru/katalog/usiliteli_resivery_stereo/"},
	{title: "Экраны", href: "http://elitehifi.spb.ru/katalog/krany/"},
	{title: "iPod Плееры", href: "http://elitehifi.spb.ru/katalog/pleery_apple_ipod/"},
	{title: "iPod Док станции", href: "http://elitehifi.spb.ru/katalog/tovary_dlya_i-pod/"},
	{title: "Статьи и Рекомендации", href: "http://elitehifi.spb.ru/katalog/stati_i_rekomendacii/"}
]


require 'nokogiri'
require 'open-uri' 

class Category 
	attr_accessor :link
	attr_accessor :text
end

class CategoryParser
	def ls_categories()
		arr = []
		doc 		= Nokogiri::HTML(open("http://elitehifi.spb.ru/katalog")).xpath('//ul[@class="categories"]')
		categories 	= doc.first unless doc.empty? 

		0.upto(categories.children.length) do |row|
			begin
				category = Category.new
				category.link = categories.children[row].children[1]['href']
				category.text = categories.children[row].children[1].text
				arr.push(category)
			rescue Exception => e
					
			end

		end
		arr
	end

end

result = CategoryParser.new.ls_categories 

result.each do |cat| 
	puts cat.inspect
end 








require 'nokogiri'
require 'open-uri' 

class Brand 
	attr_accessor :link
	attr_accessor :text
end

class ProductParser
	def get_data()
		arr = []
		doc 		= Nokogiri::HTML(open("http://elitehifi.spb.ru/katalog/vinil")).xpath('//ul[@class="categories"]')
		categories 	= doc.first unless doc.empty? 

		0.upto(categories.children.length) do |row|
			begin
				brand = Brand.new
				brand.link = categories.children[row].children[1]['href']
				brand.text = categories.children[row].children[1].text
				arr.push(brand)
			rescue Exception => e
					
			end

		end
		arr
	end

end

result = BrandParser.new.ls_brands 

result.each do |cat| 
	puts cat.inspect
end 

doc = Nokogiri::HTML(open("http://elitehifi.spb.ru/katalog/resivery_av/harman_kardon/harmankardon_avr-171/"))
http://elitehifi.spb.ru/katalog/resivery_av/harman_kardon/harmankardon_avr-171/