
# -*- coding: utf-8 -*-
"""
@author: Govind
"""

#program to find sum of even digit(s) and product of odd digit(s) of a given number

num = int(input("Enter the number: "));

i = num;
product = 1;
sum = 0;

while(i > 0):
    digit = (i % 10);
    
    if(digit % 2 == 0):
        sum += digit;
    else:
        product *= digit;
    
    digit = None;
    i //= 10;

print("The Sum of the even digit(s) of the number (", num, ") is: ", sum);
print("The Product of the odd digit(s) of the number (", num, ") is: ", product);
