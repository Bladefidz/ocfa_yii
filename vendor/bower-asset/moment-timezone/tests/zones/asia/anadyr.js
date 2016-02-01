"use strict";

var helpers = require("../../helpers/helpers");

exports["Asia/Anadyr"] = {
	"guess" : helpers.makeTestGuess("Asia/Anadyr", { offset: false, abbr: true }),

	"1924" : helpers.makeTestYear("Asia/Anadyr", [
		["1924-05-01T12:10:03+00:00", "23:59:59", "LMT", -42596 / 60],
		["1924-05-01T12:10:04+00:00", "00:10:04", "ANAT", -720]
	]),

	"1930" : helpers.makeTestYear("Asia/Anadyr", [
		["1930-06-20T11:59:59+00:00", "23:59:59", "ANAT", -720],
		["1930-06-20T12:00:00+00:00", "01:00:00", "ANAT", -780]
	]),

	"1981" : helpers.makeTestYear("Asia/Anadyr", [
		["1981-03-31T10:59:59+00:00", "23:59:59", "ANAT", -780],
		["1981-03-31T11:00:00+00:00", "01:00:00", "ANAST", -840],
		["1981-09-30T09:59:59+00:00", "23:59:59", "ANAST", -840],
		["1981-09-30T10:00:00+00:00", "23:00:00", "ANAT", -780]
	]),

	"1982" : helpers.makeTestYear("Asia/Anadyr", [
		["1982-03-31T10:59:59+00:00", "23:59:59", "ANAT", -780],
		["1982-03-31T11:00:00+00:00", "00:00:00", "ANAST", -780],
		["1982-09-30T10:59:59+00:00", "23:59:59", "ANAST", -780],
		["1982-09-30T11:00:00+00:00", "23:00:00", "ANAT", -720]
	]),

	"1983" : helpers.makeTestYear("Asia/Anadyr", [
		["1983-03-31T11:59:59+00:00", "23:59:59", "ANAT", -720],
		["1983-03-31T12:00:00+00:00", "01:00:00", "ANAST", -780],
		["1983-09-30T10:59:59+00:00", "23:59:59", "ANAST", -780],
		["1983-09-30T11:00:00+00:00", "23:00:00", "ANAT", -720]
	]),

	"1984" : helpers.makeTestYear("Asia/Anadyr", [
		["1984-03-31T11:59:59+00:00", "23:59:59", "ANAT", -720],
		["1984-03-31T12:00:00+00:00", "01:00:00", "ANAST", -780],
		["1984-09-29T13:59:59+00:00", "02:59:59", "ANAST", -780],
		["1984-09-29T14:00:00+00:00", "02:00:00", "ANAT", -720]
	]),

	"1985" : helpers.makeTestYear("Asia/Anadyr", [
		["1985-03-30T13:59:59+00:00", "01:59:59", "ANAT", -720],
		["1985-03-30T14:00:00+00:00", "03:00:00", "ANAST", -780],
		["1985-09-28T13:59:59+00:00", "02:59:59", "ANAST", -780],
		["1985-09-28T14:00:00+00:00", "02:00:00", "ANAT", -720]
	]),

	"1986" : helpers.makeTestYear("Asia/Anadyr", [
		["1986-03-29T13:59:59+00:00", "01:59:59", "ANAT", -720],
		["1986-03-29T14:00:00+00:00", "03:00:00", "ANAST", -780],
		["1986-09-27T13:59:59+00:00", "02:59:59", "ANAST", -780],
		["1986-09-27T14:00:00+00:00", "02:00:00", "ANAT", -720]
	]),

	"1987" : helpers.makeTestYear("Asia/Anadyr", [
		["1987-03-28T13:59:59+00:00", "01:59:59", "ANAT", -720],
		["1987-03-28T14:00:00+00:00", "03:00:00", "ANAST", -780],
		["1987-09-26T13:59:59+00:00", "02:59:59", "ANAST", -780],
		["1987-09-26T14:00:00+00:00", "02:00:00", "ANAT", -720]
	]),

	"1988" : helpers.makeTestYear("Asia/Anadyr", [
		["1988-03-26T13:59:59+00:00", "01:59:59", "ANAT", -720],
		["1988-03-26T14:00:00+00:00", "03:00:00", "ANAST", -780],
		["1988-09-24T13:59:59+00:00", "02:59:59", "ANAST", -780],
		["1988-09-24T14:00:00+00:00", "02:00:00", "ANAT", -720]
	]),

	"1989" : helpers.makeTestYear("Asia/Anadyr", [
		["1989-03-25T13:59:59+00:00", "01:59:59", "ANAT", -720],
		["1989-03-25T14:00:00+00:00", "03:00:00", "ANAST", -780],
		["1989-09-23T13:59:59+00:00", "02:59:59", "ANAST", -780],
		["1989-09-23T14:00:00+00:00", "02:00:00", "ANAT", -720]
	]),

	"1990" : helpers.makeTestYear("Asia/Anadyr", [
		["1990-03-24T13:59:59+00:00", "01:59:59", "ANAT", -720],
		["1990-03-24T14:00:00+00:00", "03:00:00", "ANAST", -780],
		["1990-09-29T13:59:59+00:00", "02:59:59", "ANAST", -780],
		["1990-09-29T14:00:00+00:00", "02:00:00", "ANAT", -720]
	]),

	"1991" : helpers.makeTestYear("Asia/Anadyr", [
		["1991-03-30T13:59:59+00:00", "01:59:59", "ANAT", -720],
		["1991-03-30T14:00:00+00:00", "02:00:00", "ANAST", -720],
		["1991-09-28T14:59:59+00:00", "02:59:59", "ANAST", -720],
		["1991-09-28T15:00:00+00:00", "02:00:00", "ANAT", -660]
	]),

	"1992" : helpers.makeTestYear("Asia/Anadyr", [
		["1992-01-18T14:59:59+00:00", "01:59:59", "ANAT", -660],
		["1992-01-18T15:00:00+00:00", "03:00:00", "ANAT", -720],
		["1992-03-28T10:59:59+00:00", "22:59:59", "ANAT", -720],
		["1992-03-28T11:00:00+00:00", "00:00:00", "ANAST", -780],
		["1992-09-26T09:59:59+00:00", "22:59:59", "ANAST", -780],
		["1992-09-26T10:00:00+00:00", "22:00:00", "ANAT", -720]
	]),

	"1993" : helpers.makeTestYear("Asia/Anadyr", [
		["1993-03-27T13:59:59+00:00", "01:59:59", "ANAT", -720],
		["1993-03-27T14:00:00+00:00", "03:00:00", "ANAST", -780],
		["1993-09-25T13:59:59+00:00", "02:59:59", "ANAST", -780],
		["1993-09-25T14:00:00+00:00", "02:00:00", "ANAT", -720]
	]),

	"1994" : helpers.makeTestYear("Asia/Anadyr", [
		["1994-03-26T13:59:59+00:00", "01:59:59", "ANAT", -720],
		["1994-03-26T14:00:00+00:00", "03:00:00", "ANAST", -780],
		["1994-09-24T13:59:59+00:00", "02:59:59", "ANAST", -780],
		["1994-09-24T14:00:00+00:00", "02:00:00", "ANAT", -720]
	]),

	"1995" : helpers.makeTestYear("Asia/Anadyr", [
		["1995-03-25T13:59:59+00:00", "01:59:59", "ANAT", -720],
		["1995-03-25T14:00:00+00:00", "03:00:00", "ANAST", -780],
		["1995-09-23T13:59:59+00:00", "02:59:59", "ANAST", -780],
		["1995-09-23T14:00:00+00:00", "02:00:00", "ANAT", -720]
	]),

	"1996" : helpers.makeTestYear("Asia/Anadyr", [
		["1996-03-30T13:59:59+00:00", "01:59:59", "ANAT", -720],
		["1996-03-30T14:00:00+00:00", "03:00:00", "ANAST", -780],
		["1996-10-26T13:59:59+00:00", "02:59:59", "ANAST", -780],
		["1996-10-26T14:00:00+00:00", "02:00:00", "ANAT", -720]
	]),

	"1997" : helpers.makeTestYear("Asia/Anadyr", [
		["1997-03-29T13:59:59+00:00", "01:59:59", "ANAT", -720],
		["1997-03-29T14:00:00+00:00", "03:00:00", "ANAST", -780],
		["1997-10-25T13:59:59+00:00", "02:59:59", "ANAST", -780],
		["1997-10-25T14:00:00+00:00", "02:00:00", "ANAT", -720]
	]),

	"1998" : helpers.makeTestYear("Asia/Anadyr", [
		["1998-03-28T13:59:59+00:00", "01:59:59", "ANAT", -720],
		["1998-03-28T14:00:00+00:00", "03:00:00", "ANAST", -780],
		["1998-10-24T13:59:59+00:00", "02:59:59", "ANAST", -780],
		["1998-10-24T14:00:00+00:00", "02:00:00", "ANAT", -720]
	]),

	"1999" : helpers.makeTestYear("Asia/Anadyr", [
		["1999-03-27T13:59:59+00:00", "01:59:59", "ANAT", -720],
		["1999-03-27T14:00:00+00:00", "03:00:00", "ANAST", -780],
		["1999-10-30T13:59:59+00:00", "02:59:59", "ANAST", -780],
		["1999-10-30T14:00:00+00:00", "02:00:00", "ANAT", -720]
	]),

	"2000" : helpers.makeTestYear("Asia/Anadyr", [
		["2000-03-25T13:59:59+00:00", "01:59:59", "ANAT", -720],
		["2000-03-25T14:00:00+00:00", "03:00:00", "ANAST", -780],
		["2000-10-28T13:59:59+00:00", "02:59:59", "ANAST", -780],
		["2000-10-28T14:00:00+00:00", "02:00:00", "ANAT", -720]
	]),

	"2001" : helpers.makeTestYear("Asia/Anadyr", [
		["2001-03-24T13:59:59+00:00", "01:59:59", "ANAT", -720],
		["2001-03-24T14:00:00+00:00", "03:00:00", "ANAST", -780],
		["2001-10-27T13:59:59+00:00", "02:59:59", "ANAST", -780],
		["2001-10-27T14:00:00+00:00", "02:00:00", "ANAT", -720]
	]),

	"2002" : helpers.makeTestYear("Asia/Anadyr", [
		["2002-03-30T13:59:59+00:00", "01:59:59", "ANAT", -720],
		["2002-03-30T14:00:00+00:00", "03:00:00", "ANAST", -780],
		["2002-10-26T13:59:59+00:00", "02:59:59", "ANAST", -780],
		["2002-10-26T14:00:00+00:00", "02:00:00", "ANAT", -720]
	]),

	"2003" : helpers.makeTestYear("Asia/Anadyr", [
		["2003-03-29T13:59:59+00:00", "01:59:59", "ANAT", -720],
		["2003-03-29T14:00:00+00:00", "03:00:00", "ANAST", -780],
		["2003-10-25T13:59:59+00:00", "02:59:59", "ANAST", -780],
		["2003-10-25T14:00:00+00:00", "02:00:00", "ANAT", -720]
	]),

	"2004" : helpers.makeTestYear("Asia/Anadyr", [
		["2004-03-27T13:59:59+00:00", "01:59:59", "ANAT", -720],
		["2004-03-27T14:00:00+00:00", "03:00:00", "ANAST", -780],
		["2004-10-30T13:59:59+00:00", "02:59:59", "ANAST", -780],
		["2004-10-30T14:00:00+00:00", "02:00:00", "ANAT", -720]
	]),

	"2005" : helpers.makeTestYear("Asia/Anadyr", [
		["2005-03-26T13:59:59+00:00", "01:59:59", "ANAT", -720],
		["2005-03-26T14:00:00+00:00", "03:00:00", "ANAST", -780],
		["2005-10-29T13:59:59+00:00", "02:59:59", "ANAST", -780],
		["2005-10-29T14:00:00+00:00", "02:00:00", "ANAT", -720]
	]),

	"2006" : helpers.makeTestYear("Asia/Anadyr", [
		["2006-03-25T13:59:59+00:00", "01:59:59", "ANAT", -720],
		["2006-03-25T14:00:00+00:00", "03:00:00", "ANAST", -780],
		["2006-10-28T13:59:59+00:00", "02:59:59", "ANAST", -780],
		["2006-10-28T14:00:00+00:00", "02:00:00", "ANAT", -720]
	]),

	"2007" : helpers.makeTestYear("Asia/Anadyr", [
		["2007-03-24T13:59:59+00:00", "01:59:59", "ANAT", -720],
		["2007-03-24T14:00:00+00:00", "03:00:00", "ANAST", -780],
		["2007-10-27T13:59:59+00:00", "02:59:59", "ANAST", -780],
		["2007-10-27T14:00:00+00:00", "02:00:00", "ANAT", -720]
	]),

	"2008" : helpers.makeTestYear("Asia/Anadyr", [
		["2008-03-29T13:59:59+00:00", "01:59:59", "ANAT", -720],
		["2008-03-29T14:00:00+00:00", "03:00:00", "ANAST", -780],
		["2008-10-25T13:59:59+00:00", "02:59:59", "ANAST", -780],
		["2008-10-25T14:00:00+00:00", "02:00:00", "ANAT", -720]
	]),

	"2009" : helpers.makeTestYear("Asia/Anadyr", [
		["2009-03-28T13:59:59+00:00", "01:59:59", "ANAT", -720],
		["2009-03-28T14:00:00+00:00", "03:00:00", "ANAST", -780],
		["2009-10-24T13:59:59+00:00", "02:59:59", "ANAST", -780],
		["2009-10-24T14:00:00+00:00", "02:00:00", "ANAT", -720]
	]),

	"2010" : helpers.makeTestYear("Asia/Anadyr", [
		["2010-03-27T13:59:59+00:00", "01:59:59", "ANAT", -720],
		["2010-03-27T14:00:00+00:00", "02:00:00", "ANAST", -720],
		["2010-10-30T14:59:59+00:00", "02:59:59", "ANAST", -720],
		["2010-10-30T15:00:00+00:00", "02:00:00", "ANAT", -660]
	]),

	"2011" : helpers.makeTestYear("Asia/Anadyr", [
		["2011-03-26T14:59:59+00:00", "01:59:59", "ANAT", -660],
		["2011-03-26T15:00:00+00:00", "03:00:00", "ANAT", -720]
	])
};