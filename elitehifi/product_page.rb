require 'nokogiri'
require 'open-uri' 
require 'json' 
class Product
	attr_accessor :full_text 
	attr_accessor :price 

	def initialize 
		@images = []
	end

	def images
		@images 
	end 

end 


product 	= Product.new 
doc 		= Nokogiri::HTML(open('http://elitehifi.spb.ru/katalog/resivery_av/harman_kardon/harmankardon_avr-151/'))
info_block 	= doc.search('.product-info-td')[1]

product.full_text = info_block.children.first.text
product.price	  = doc.search('.product-price').first.text 

images	 		  = doc.search('.fancybox')


images.each do |image|
	entry = {
		"small_image" => image.children.first['src'],
		"big_image"   => image['href']
	}

	product.images.push(entry)
end 

puts product.images.to_json 




