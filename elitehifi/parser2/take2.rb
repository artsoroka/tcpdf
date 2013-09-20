require './cat.rb' 
require './product_list_file.rb'
require './dbproducts.rb'
require './vfsfiles.rb'
require './dbcategories.rb' 
require './brands.rb'

dbVfsFiles = DBvfsFiles.new 
dbcategories = DBcategories.new 
dbproducts = DBproducts.new(dbVfsFiles)   


class SubCat
	attr_accessor :text
	attr_accessor :link
end

counter = 0
CategoryParser.new.ls_categories.each do |category| 

	puts "Starting category #{category.text}" 
	
	catId = dbcategories.insert category 

	brands = Brands.new category 

	brands.list.each do |brand|

		puts "Begin parsing sub category #{brand['name']} \n"

		subcat = SubCat.new 
		subcat.text = brand['name']
		subcat.link = brand['link']

		subcatId = dbcategories.insert(subcat, catId)  

		dbproducts.set_category_id subcatId 	

		products = Products.new("http://elitehifi.spb.ru#{subcat.link}")

		products.list.each do |product|
			product.get_details
			puts "Adding #{product.title} to products table \n"
			dbproducts.insert product

		end 

	end
	
end


	puts "Saving products.sql "
	dbproducts.save_to_file './sql/products.sql'

	puts "Saving VFS.sql "
	dbVfsFiles.save_to_file './sql/vfs.sql'
				
	puts "Saving categories.sql "
	dbcategories.save_to_file './sql/categories.sql'

