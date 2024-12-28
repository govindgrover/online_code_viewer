
# -*- coding: utf-8 -*-
"""
@author: Govind
"""

#program to reverse a given number

print("program to reverse a given number");

i = int(input("Enter the number: "));
rev = 0;

while(i > 0):
    rev = (rev * 10) + (i % 10);

    i //= 10;

print("Revered of the number is: ", rev);
