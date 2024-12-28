
# -*- coding: utf-8 -*-
"""
@author: Govind
"""

# program to calculate area of triangle by the length of sides

a = float(input("Enter the length of First side: "));
b = float(input("Enter the length of Second side: "));
c = float(input("Enter the length of Third side: "));

s = ((a + b + c) / 2);

area = ((s * (s - a) * (s - b) * (s - c)) ** 0.5);

print("The area of the triangle is: ", area);
