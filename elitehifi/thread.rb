require './cat.rb' 

threads = [] 

CategoryParser.new.ls_categories.each do |category| 
	threads << Thread.new do 
		puts "Begin parsing category #{category.text} \n"

		file = File.new("./filez/#{category.text.gsub('/', '-')}.txt", "a")

		products = Products.new("http://elitehifi.spb.ru#{category.link}")

		products.list.each do |product|
			product.get_details
			puts "writing to file #{category.text}.txt \n" 
			file.puts(product.to_json + "\n")
		end 

		file.close

	end
end

threads.each(&:join) 