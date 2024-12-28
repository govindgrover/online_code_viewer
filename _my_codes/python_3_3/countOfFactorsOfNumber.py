
# -*- coding: utf-8 -*-
"""
@author: Govind
"""

#program to find all the factors of a given number

print("program to find all the factors of a given number");

num = int(input("Enter the number: "))

# making the "half" of the number "even" 'if it is odd'
if num % 2 == 0 :
	half = (num // 2)
else:
	half = (num // 2) + 1

count = 0
i = 1

while i <= half:
	if (num % i) == 0:
		count += 1
	
	i += 1

# the number is itself a factor of own
count += 1
print("Count of factors of {} are: {}".format(num, count))
