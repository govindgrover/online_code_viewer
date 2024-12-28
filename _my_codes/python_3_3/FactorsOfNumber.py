
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

print("Factors of", num, "are:-")

i = 1
while i <= half:
	if (num % i) == 0:
		print(i)

	i += 1

# the number is itself a factor of own
print("and ", num, "\n")
