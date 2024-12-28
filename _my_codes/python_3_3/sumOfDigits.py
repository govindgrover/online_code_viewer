
# -*- coding: utf-8 -*-
"""
@author: Govind
"""

#program to find sum of digit(s) of a given number

num = int(input("Enter the number: "));

i = num;
sum = 0;

while(i > 0):
    sum += (i % 10);
    
    i //= 10;

print("The sum of the digit(s) of the number (", num, ") is: ", sum);
