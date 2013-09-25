require 'nokogiri'
require 'open-uri' 

module SERIALIZE

	require 'json' 

	def to_json()
		hash = {}
		self.instance_variables.each do |var|
			hash[var.to_s.gsub("@","")] = self.instance_variable_get var
		end
		hash.to_json
	end
end

class Category 

	attr_accessor :link
	attr_accessor :text
	attr_accessor :db_id

	include SERIALIZE

	def to_json()
		hash = {}
		self.instance_variables.each do |var|
			hash[var.to_s.gsub("@","")] = self.instance_variable_get var
		end
		hash.to_json
	end
end

class CategoryParser
	
	def initialize()
		self.parse_category_list()
	end 

	def ls_categories()
		@result 
	end

	protected

	def parse_category_list()
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
		@result = arr
	end

end
################
#result = CategoryParser.new.ls_categories 

#result.each do |cat| 
#	puts cat.to_json + "\n" 
#end 


#	products = Products.new 
#	products in category each do |product|
#		product save_to_file  
#	end 

