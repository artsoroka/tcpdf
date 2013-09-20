require 'nokogiri'
require 'open-uri'

class Array
	def add entry
	
		begin

			brand = {
				"name" => entry.children[1].text,
				"link" => entry.children[1]['href']
			}

			self.push brand 

		rescue Exception => e
			puts "Something gone wrong while parsing brands\n"
			puts e 			
		end
	
	end
end

#class Category
#	attr_accessor :link 
#	def initialize url 
#		@link = url
#	end
#end

class Brands
	def initialize category
		@base_url = 'http://elitehifi.spb.ru'
		@brands = []
		@page 	= Nokogiri::HTML( open category.link.prepend(@base_url) ) 

		self.parse_brands_list
	end

	def list 
		@brands
	end

	protected 

	def parse_brands_list

		categories = @page.xpath('//ul[@class="categories"]')

		categories.children.each_with_index do |entry, index|
			@brands.add entry if index.even? 
		end

	end
end

### USAGE 
# cat 	= Category.new 'http://elitehifi.spb.ru/katalog/naushniki/'
# cat 	= Category.new 'http://elitehifi.spb.ru/katalog/proigryvateli_cd_sacd/'
# brands 	= Brands.new cat
# puts brands.list 