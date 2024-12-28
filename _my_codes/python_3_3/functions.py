
# -*- coding: utf-8 -*-
"""
@author: Govind
"""

def decimalLength(num):
	str_num = str(num);

	if not '.' in str_num:
		return 0;
	else:
		return len(str_num) - str_num.index('.') - 1;
