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

class Product 
	attr_accessor :title
	attr_accessor :link
	attr_accessor :description

	include SERIALIZE


##############
	attr_accessor :full_text 
	attr_accessor :price 

	def initialize 
		@images 		= []
		@metaDetails 	= []
	end

	def images
		@images 
	end 


	def get_details

		doc 		= Nokogiri::HTML(open("http://elitehifi.spb.ru#{@link}"))
		info_block 	= doc.search('.product-info-td')[1]

		begin
			
			@full_text = info_block.children.first.text
			@price	  = doc.search('.product-price').first.text 
			
		rescue Exception => e
			
		end

		begin
				
			images	 		  = doc.search('.fancybox')

			images.each do |image|
				entry = {
					"small_image" => image.children.first['src'],
					"big_image"   => image['href']
				}

				@images.push(entry)
			end 			
		rescue Exception => e
			
		end

		### Monday ) 
		begin
			metaTags = doc.xpath('//meta')

			metaTags.each do |meta|
				@metaDetails.push meta.attributes.to_json
			end

		rescue Exception => e
			
		end
		### 

	end
############# 
end

result = []



class Products

	def initialize(category_uri, pagination = "?p=")
		@category_uri 	= category_uri
		@pagination		= pagination
		@result 		= []	
		self.get_product_list()
	end 

	def list()
		@result
	end

	protected 

	def get_product_list()
		
		0.upto(100) do |page| 

			doc = Nokogiri::HTML(open(@category_uri + @pagination + page.to_s))
			products = doc.search('.product') 

			break if products.empty? 

			# 10 per page 
			products.each do |entry|

				product = Product.new
					
				product.title 			= entry.children[1].children.first.text
				product.link			= entry.children[1].children.first['href'] 
				product.description 	= entry.children[3].children.first.text

				@result.push(product)

			end 
		end
		#@result = result
	end

end

#products = Products.new("http://elitehifi.spb.ru/katalog/resivery_av/", "?p=")

#products.list.each do |product|
#	puts product.to_json + "\n"
#end 

