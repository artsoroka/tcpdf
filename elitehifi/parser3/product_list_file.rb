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
			
			#@full_text = info_block.children.first.text
			#@full_text = info_block.text
			
			# FRIDAY UPDATES
			
			#@full_text = ""
			
			#0.upto(info_block.children.length - 1) do |i| 
			#	entry = info_block.children[i]
				#@full_text += entry.text unless entry.attributes['class'] && entry.attributes['class'].value == 'product-price'
			#	@full_text += entry.to_s unless entry.attributes['class'] && entry.attributes['class'].value == 'product-price'
			#end
			
			########



			# Thursday 


			@full_text = "" 

			info_block.children.to_a.each do |element|
				@full_text += element.to_s.gsub("'", '"') if element.attributes.empty?  
			
				if element['class'] == 'product-chatacteristics' 
							
						spec_list = []

						element.children.each_with_index do |spec, index|
							spec = spec.to_s 

							spec.gsub!('<dt>', '<td class="fade">')
							spec.gsub!('</dt>', '</td>') 
							spec.gsub!('<dd>', '<td>') 
							spec.gsub!('</dd>', '</td>') 
							
							spec_list.push spec if index.even?  

						end 

						result = ""
						spec_list.each_with_index do |e, index|
							result += e.prepend("<tr>") if index.even? 
							result += e << "</tr>" if index.odd? 
						end

						result .prepend('<table class="table"><tbody><tr><th colspan="2">Характеристики</th></tr>')
						result  << "</tbody></table>"
						
						@full_text += result 

				end














			end 




			#

			@price	  = doc.search('.product-price').first.text 
			
		rescue Exception => e
			puts "Something gone wrong while parsing .product-info-td \n"
			puts e

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

