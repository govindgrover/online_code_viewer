
# -*- coding: utf-8 -*-
"""
@author: Govind
"""

import os
from sys import exit
import math

def isPerfectSquare(num):
	sqrt_str = str(math.sqrt(num))
	splited = sqrt_str.split('.')

	if (splited[1] == '0' and len(splited[1]) == 1):
		return True

	return False


def tryToShortTheRHSOf(eq):

	return eq


def solveQuadraticEquation(a_dig = "", b_dig = "", c_dig = ""):
	a = b = c = 0
	iota = ""
	roots = []

	os.system("cls")

	if(a_dig == "" and b_dig == "" and c_dig == ""):
		print("\nHi there!")
		print("\nTo enter square-root in the place of \'a, b or c\', please write as -> \"sqrt(n), sqrt(-n)\"")
		print("\nLet the quadric equation be ax^2 + bx + c = 0 ----(1)\n")
		
		a_dig = (input("Enter value for 'a' in the equation(1): "))
		b_dig = (input("Enter value for 'b' in the equation(1): "))
		c_dig = (input("Enter value for 'c' in the equation(1): "))
	
	# if the given input is square-root
	# for a in eq(1)
	try:
		a = int(a_dig)
	except ValueError:
		# if the given input is not the square-root, then
		try:
			a = str(a_dig.split("sqrt(")).split(")")[0].split("['', '")[1]
		except IndexError:
			try:
				a = int(a_dig)
			except ValueError:
				print("Error: Invalid Input for 'a'!")
				exit()
	
	# for b in eq(1)
	try:
		b = int(b_dig)
	except ValueError:
		# if the given input is not the square-root, then
		try:
			b = str(b_dig.split("sqrt(")).split(")")[0].split("['', '")[1]
		except IndexError:
			try:
				b = int(b_dig)
			except ValueError:
				print("Error: Invalid Input for 'b'!")
				exit()
	
	# for b in eq(1)
	try:
		c = int(c_dig)
	except ValueError:
		# if the given input is not the square-root, then
		try:
			c = str(c_dig.split("sqrt(")).split(")")[0].split("['', '")[1]
		except IndexError:
			try:
				c = int(c_dig)
			except ValueError:
				print("Error: Invalid Input for 'c'!")
				exit()
	
	
	discriminant = ( ( b ** 2 ) - ( 4 * a * c ) )
	
	if(discriminant < 0):
		rootsType = "complex"
	elif(discriminant == 0):
		rootsType = "equal"
	else:
		rootsType = "normal"
	
	
	print("\nThis equation is going to give the", rootsType, " roots. The discriminant is: ", discriminant)
	
	
	for x in [0, 1]:
		if(discriminant < 0):
			discriminant = (-1 * discriminant)
			iota = "i"
	
	
		if(x == 1):
				sign = "+"
		else:
			sign = "-"
	
		if(isPerfectSquare(discriminant)):
			eq = "({} {} {}{}/{})".format( (-1 * b), sign, int(math.sqrt(discriminant)), iota, (2 * a) )
		else:
			eq = "({} {} sqrt({}){}/{})".format( (-1 * b), sign, discriminant, iota, (2 * a) )
	
		roots.append(tryToShortTheRHSOf(eq))
	
	
	print("\nThe required roots of the quadric equation are: ", roots)


solveQuadraticEquation("", "", "")