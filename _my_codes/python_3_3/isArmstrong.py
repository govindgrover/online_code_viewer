
# -*- coding: utf-8 -*-
"""
@author: Govind
"""

#program to find the given number is armstrong number or not

num = int(input("Enter the number: "));

i = num;
sum = 0;

while(i > 0):
    digit = (i % 10);
        
    sum += (digit ** 3);

    digit = None;
    i //= 10;


if(num == sum):
    print("The given number (", num, ") is the armstrong number.");
else:
    print("The given number (", num, ") is not the armstrong number.");
