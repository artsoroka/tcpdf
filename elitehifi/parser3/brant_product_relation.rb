# encoding: UTF-8 

require './cat.rb' 
require './product_list_file.rb'
require './dbproducts.rb'
require './vfsfiles.rb'
require './dbcategories.rb' 
require './brands.rb'
require './dbimageobject.rb' 


dbVfsFiles = DBvfsFiles.new 
dbObjectImages = DBobjectImages.new 
dbcategories = DBcategories.new 
dbproducts = DBproducts.new(dbVfsFiles, dbObjectImages)    

keyvaldata = []
class KeyVal
		attr_accessor :brand
		attr_accessor :product
end



class SubCat
	attr_accessor :text
	attr_accessor :link
end

counter = 0
CategoryParser.new.ls_categories.each do |category| 

	if counter < 100 



		puts "Starting category #{category.text}" 
	
		catId = dbcategories.insert category 
		category.db_id = catId 

		brands = Brands.new category 

		brands.list.each do |brand|

			puts "Begin parsing sub category #{brand['name']} \n"

			subcat = SubCat.new 
			subcat.text = brand['name']
			subcat.link = brand['link']

			subcatId = dbcategories.insert(subcat, category)  

			dbproducts.set_category_id subcatId 	
			#dbproducts.set_category_id catId 	
			#dbproducts.set_prefix category.link.split('/').last

			products = Products.new("http://elitehifi.spb.ru#{subcat.link}")

			products.list.each do |product|
				product.get_details
				puts "Adding #{product.title} to products table \n"
				dbproducts.insert product

				kv = KeyVal.new
				kv.brand 	= brand['name'] 
				kv.product 	= product.title

				keyvaldata.push kv 
				puts "#{kv.brand} : #{kv.product} \n" 

			end 

		end

	end 

	counter += 1

end

file = File.new('b-p.csv', "a")

keyvaldata.each do |entry|
	file.puts("'#{entry.brand}', '#{entry.product}'\n")
end

file.close

