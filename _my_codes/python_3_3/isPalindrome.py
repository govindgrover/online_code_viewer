
# -*- coding: utf-8 -*-
"""
@author: Govind
"""

#program to check weather a number is a palindrome number or not

input_str = input("Enter the number: ");
i = len(input_str);

reversed_str = "";

while(i != 0):
    reversed_str += str((input_str[(i - 1)]));
    
    i -= 1;

if(input_str == reversed_str):
    print("The given number is a Palindrome Number.")
else:
    print("The given number is not a Palindrome Number.")
