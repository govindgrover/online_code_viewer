
# -*- coding: utf-8 -*-
"""
@author: Govind
"""

# program to calculate factorial of a given number

num = int(input("Enter the number: "));

if(num > 9999):
    print("\nThe time taken by the code to execute and give results will depends upon your system configuration.\n\
          If you want to cancel the process press: \" ctrl + c \"\n");

fact = 1;
original_num = num;
i = num;

while i > 0:
    fact *= i;
    
    i -= 1;

print(fact);
