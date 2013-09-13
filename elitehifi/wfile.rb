require 'open-uri'



dirname = Dir.pwd + '/' + "test"

Dir.mkdir(dirname)

file = File.new("#{dirname}/somefile.jpg", "a")
file << open('http://elitehifi.spb.ru/images/cms/data/catalog/marantz_tt5005.jpg').read

file.close


