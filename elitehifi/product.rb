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
