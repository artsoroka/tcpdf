require 'nokogiri'
require 'open-uri' 

class Product

	attr_accessor :full_text 
	attr_accessor :price 

end 


product 	= Product.new 
doc 		= Nokogiri::HTML(open('http://elitehifi.spb.ru/katalog/resivery_av/harman_kardon/harmankardon_avr-151/'))
info_block 	= doc.search('.product-info-td')[1]

product.full_text = info_block.children.first.text
product.price	  = doc.search('.product-price').first.text 

puts product.inspect 




