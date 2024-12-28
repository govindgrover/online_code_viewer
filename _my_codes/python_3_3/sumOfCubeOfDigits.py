
# -*- coding: utf-8 -*-
"""
@author: Govind
"""

#program to find sum of cube of digit(s) of a given number

num = int(input("Enter the number: "));

i = num;
sum = 0;

while(i > 0):
    digit = (i % 10);
        
    sum += (digit ** 3);

    digit = None;
    i //= 10;

print("The sum of the cube of digit(s) of the number (", num, ") is: ", sum);
