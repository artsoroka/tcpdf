# encoding: UTF-8 


require 'open-uri'
require 'nokogiri'

doc = Nokogiri::HTML(open('http://elitehifi.spb.ru/katalog/minisistemy/marantz/marantz_ms7000_consolette1/')) 


block = doc.search('.product-info-td')[1] 

product_description = "" 

block.children.to_a.each do |element|
	product_description += element.to_s.gsub("'", '"') if element.attributes.empty?  

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
		
		product_description += result 



	end 

end 


file = File.new("result.txt", "a")
file << product_description.to_s 
file.close

