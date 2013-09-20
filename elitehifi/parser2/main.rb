require './cat.rb' 
require './product_list_file.rb'
require './dbproducts.rb'
require './vfsfiles.rb'
require './dbcategories.rb' 


dbVfsFiles = DBvfsFiles.new 
dbcategories = DBcategories.new 
dbproducts = DBproducts.new(dbVfsFiles)   


counter = 0
CategoryParser.new.ls_categories.each do |category| 
	puts "Begin parsing category #{category.text} \n"

	catId = dbcategories.insert category 

	dbproducts.set_category_id catId 	

	products = Products.new("http://elitehifi.spb.ru#{category.link}")

	products.list.each do |product|
		product.get_details
		puts "Adding #{product.title} to products table \n"
		dbproducts.insert product

	end 
	counter += 1


	puts "Saving products.sql "
	dbproducts.save_to_file './sql/products.sql'

	puts "Saving VFS.sql "
	dbVfsFiles.save_to_file './sql/vfs.sql'
				
	puts "Saving categories.sql "
	dbcategories.save_to_file './sql/categories.sql'



end


