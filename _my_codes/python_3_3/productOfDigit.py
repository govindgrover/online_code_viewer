
# -*- coding: utf-8 -*-
"""
@author: Govind
"""

#program to find product of digit(s) of a given number

num = int(input("Enter the number: "));

i = num;
product = 1;

while(i > 0):
    product *= (i % 10);
    
    i //= 10;

print("The product of the digit(s) of the number (", num, ") is: ", product);
