"use strict";

var helpers = require("../../helpers/helpers");

exports["Asia/Baku"] = {
	"guess" : helpers.makeTestGuess("Asia/Baku", { offset: true, abbr: true }),

	"1924" : helpers.makeTestYear("Asia/Baku", [
		["1924-05-01T20:40:35+00:00", "23:59:59", "LMT", -11964 / 60],
		["1924-05-01T20:40:36+00:00", "23:40:36", "BAKT", -180]
	]),

	"1957" : helpers.makeTestYear("Asia/Baku", [
		["1957-02-28T20:59:59+00:00", "23:59:59", "BAKT", -180],
		["1957-02-28T21:00:00+00:00", "01:00:00", "BAKT", -240]
	]),

	"1981" : helpers.makeTestYear("Asia/Baku", [
		["1981-03-31T19:59:59+00:00", "23:59:59", "BAKT", -240],
		["1981-03-31T20:00:00+00:00", "01:00:00", "BAKST", -300],
		["1981-09-30T18:59:59+00:00", "23:59:59", "BAKST", -300],
		["1981-09-30T19:00:00+00:00", "23:00:00", "BAKT", -240]
	]),

	"1982" : helpers.makeTestYear("Asia/Baku", [
		["1982-03-31T19:59:59+00:00", "23:59:59", "BAKT", -240],
		["1982-03-31T20:00:00+00:00", "01:00:00", "BAKST", -300],
		["1982-09-30T18:59:59+00:00", "23:59:59", "BAKST", -300],
		["1982-09-30T19:00:00+00:00", "23:00:00", "BAKT", -240]
	]),

	"1983" : helpers.makeTestYear("Asia/Baku", [
		["1983-03-31T19:59:59+00:00", "23:59:59", "BAKT", -240],
		["1983-03-31T20:00:00+00:00", "01:00:00", "BAKST", -300],
		["1983-09-30T18:59:59+00:00", "23:59:59", "BAKST", -300],
		["1983-09-30T19:00:00+00:00", "23:00:00", "BAKT", -240]
	]),

	"1984" : helpers.makeTestYear("Asia/Baku", [
		["1984-03-31T19:59:59+00:00", "23:59:59", "BAKT", -240],
		["1984-03-31T20:00:00+00:00", "01:00:00", "BAKST", -300],
		["1984-09-29T21:59:59+00:00", "02:59:59", "BAKST", -300],
		["1984-09-29T22:00:00+00:00", "02:00:00", "BAKT", -240]
	]),

	"1985" : helpers.makeTestYear("Asia/Baku", [
		["1985-03-30T21:59:59+00:00", "01:59:59", "BAKT", -240],
		["1985-03-30T22:00:00+00:00", "03:00:00", "BAKST", -300],
		["1985-09-28T21:59:59+00:00", "02:59:59", "BAKST", -300],
		["1985-09-28T22:00:00+00:00", "02:00:00", "BAKT", -240]
	]),

	"1986" : helpers.makeTestYear("Asia/Baku", [
		["1986-03-29T21:59:59+00:00", "01:59:59", "BAKT", -240],
		["1986-03-29T22:00:00+00:00", "03:00:00", "BAKST", -300],
		["1986-09-27T21:59:59+00:00", "02:59:59", "BAKST", -300],
		["1986-09-27T22:00:00+00:00", "02:00:00", "BAKT", -240]
	]),

	"1987" : helpers.makeTestYear("Asia/Baku", [
		["1987-03-28T21:59:59+00:00", "01:59:59", "BAKT", -240],
		["1987-03-28T22:00:00+00:00", "03:00:00", "BAKST", -300],
		["1987-09-26T21:59:59+00:00", "02:59:59", "BAKST", -300],
		["1987-09-26T22:00:00+00:00", "02:00:00", "BAKT", -240]
	]),

	"1988" : helpers.makeTestYear("Asia/Baku", [
		["1988-03-26T21:59:59+00:00", "01:59:59", "BAKT", -240],
		["1988-03-26T22:00:00+00:00", "03:00:00", "BAKST", -300],
		["1988-09-24T21:59:59+00:00", "02:59:59", "BAKST", -300],
		["1988-09-24T22:00:00+00:00", "02:00:00", "BAKT", -240]
	]),

	"1989" : helpers.makeTestYear("Asia/Baku", [
		["1989-03-25T21:59:59+00:00", "01:59:59", "BAKT", -240],
		["1989-03-25T22:00:00+00:00", "03:00:00", "BAKST", -300],
		["1989-09-23T21:59:59+00:00", "02:59:59", "BAKST", -300],
		["1989-09-23T22:00:00+00:00", "02:00:00", "BAKT", -240]
	]),

	"1990" : helpers.makeTestYear("Asia/Baku", [
		["1990-03-24T21:59:59+00:00", "01:59:59", "BAKT", -240],
		["1990-03-24T22:00:00+00:00", "03:00:00", "BAKST", -300],
		["1990-09-29T21:59:59+00:00", "02:59:59", "BAKST", -300],
		["1990-09-29T22:00:00+00:00", "02:00:00", "BAKT", -240]
	]),

	"1991" : helpers.makeTestYear("Asia/Baku", [
		["1991-03-30T21:59:59+00:00", "01:59:59", "BAKT", -240],
		["1991-03-30T22:00:00+00:00", "02:00:00", "BAKST", -240],
		["1991-08-29T19:59:59+00:00", "23:59:59", "BAKST", -240],
		["1991-08-29T20:00:00+00:00", "00:00:00", "AZST", -240],
		["1991-09-28T22:59:59+00:00", "02:59:59", "AZST", -240],
		["1991-09-28T23:00:00+00:00", "02:00:00", "AZT", -180]
	]),

	"1992" : helpers.makeTestYear("Asia/Baku", [
		["1992-03-28T19:59:59+00:00", "22:59:59", "AZT", -180],
		["1992-03-28T20:00:00+00:00", "00:00:00", "AZST", -240],
		["1992-09-26T18:59:59+00:00", "22:59:59", "AZST", -240],
		["1992-09-26T19:00:00+00:00", "23:00:00", "AZT", -240]
	]),

	"1996" : helpers.makeTestYear("Asia/Baku", [
		["1996-03-31T00:59:59+00:00", "04:59:59", "AZT", -240],
		["1996-03-31T01:00:00+00:00", "06:00:00", "AZST", -300],
		["1996-10-27T00:59:59+00:00", "05:59:59", "AZST", -300],
		["1996-10-27T01:00:00+00:00", "05:00:00", "AZT", -240]
	]),

	"1997" : helpers.makeTestYear("Asia/Baku", [
		["1997-03-29T23:59:59+00:00", "03:59:59", "AZT", -240],
		["1997-03-30T00:00:00+00:00", "05:00:00", "AZST", -300],
		["1997-10-25T23:59:59+00:00", "04:59:59", "AZST", -300],
		["1997-10-26T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"1998" : helpers.makeTestYear("Asia/Baku", [
		["1998-03-28T23:59:59+00:00", "03:59:59", "AZT", -240],
		["1998-03-29T00:00:00+00:00", "05:00:00", "AZST", -300],
		["1998-10-24T23:59:59+00:00", "04:59:59", "AZST", -300],
		["1998-10-25T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"1999" : helpers.makeTestYear("Asia/Baku", [
		["1999-03-27T23:59:59+00:00", "03:59:59", "AZT", -240],
		["1999-03-28T00:00:00+00:00", "05:00:00", "AZST", -300],
		["1999-10-30T23:59:59+00:00", "04:59:59", "AZST", -300],
		["1999-10-31T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2000" : helpers.makeTestYear("Asia/Baku", [
		["2000-03-25T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2000-03-26T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2000-10-28T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2000-10-29T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2001" : helpers.makeTestYear("Asia/Baku", [
		["2001-03-24T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2001-03-25T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2001-10-27T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2001-10-28T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2002" : helpers.makeTestYear("Asia/Baku", [
		["2002-03-30T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2002-03-31T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2002-10-26T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2002-10-27T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2003" : helpers.makeTestYear("Asia/Baku", [
		["2003-03-29T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2003-03-30T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2003-10-25T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2003-10-26T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2004" : helpers.makeTestYear("Asia/Baku", [
		["2004-03-27T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2004-03-28T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2004-10-30T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2004-10-31T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2005" : helpers.makeTestYear("Asia/Baku", [
		["2005-03-26T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2005-03-27T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2005-10-29T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2005-10-30T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2006" : helpers.makeTestYear("Asia/Baku", [
		["2006-03-25T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2006-03-26T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2006-10-28T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2006-10-29T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2007" : helpers.makeTestYear("Asia/Baku", [
		["2007-03-24T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2007-03-25T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2007-10-27T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2007-10-28T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2008" : helpers.makeTestYear("Asia/Baku", [
		["2008-03-29T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2008-03-30T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2008-10-25T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2008-10-26T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2009" : helpers.makeTestYear("Asia/Baku", [
		["2009-03-28T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2009-03-29T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2009-10-24T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2009-10-25T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2010" : helpers.makeTestYear("Asia/Baku", [
		["2010-03-27T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2010-03-28T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2010-10-30T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2010-10-31T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2011" : helpers.makeTestYear("Asia/Baku", [
		["2011-03-26T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2011-03-27T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2011-10-29T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2011-10-30T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2012" : helpers.makeTestYear("Asia/Baku", [
		["2012-03-24T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2012-03-25T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2012-10-27T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2012-10-28T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2013" : helpers.makeTestYear("Asia/Baku", [
		["2013-03-30T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2013-03-31T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2013-10-26T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2013-10-27T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2014" : helpers.makeTestYear("Asia/Baku", [
		["2014-03-29T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2014-03-30T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2014-10-25T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2014-10-26T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2015" : helpers.makeTestYear("Asia/Baku", [
		["2015-03-28T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2015-03-29T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2015-10-24T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2015-10-25T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2016" : helpers.makeTestYear("Asia/Baku", [
		["2016-03-26T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2016-03-27T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2016-10-29T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2016-10-30T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2017" : helpers.makeTestYear("Asia/Baku", [
		["2017-03-25T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2017-03-26T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2017-10-28T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2017-10-29T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2018" : helpers.makeTestYear("Asia/Baku", [
		["2018-03-24T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2018-03-25T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2018-10-27T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2018-10-28T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2019" : helpers.makeTestYear("Asia/Baku", [
		["2019-03-30T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2019-03-31T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2019-10-26T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2019-10-27T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2020" : helpers.makeTestYear("Asia/Baku", [
		["2020-03-28T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2020-03-29T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2020-10-24T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2020-10-25T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2021" : helpers.makeTestYear("Asia/Baku", [
		["2021-03-27T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2021-03-28T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2021-10-30T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2021-10-31T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2022" : helpers.makeTestYear("Asia/Baku", [
		["2022-03-26T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2022-03-27T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2022-10-29T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2022-10-30T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2023" : helpers.makeTestYear("Asia/Baku", [
		["2023-03-25T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2023-03-26T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2023-10-28T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2023-10-29T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2024" : helpers.makeTestYear("Asia/Baku", [
		["2024-03-30T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2024-03-31T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2024-10-26T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2024-10-27T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2025" : helpers.makeTestYear("Asia/Baku", [
		["2025-03-29T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2025-03-30T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2025-10-25T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2025-10-26T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2026" : helpers.makeTestYear("Asia/Baku", [
		["2026-03-28T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2026-03-29T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2026-10-24T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2026-10-25T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2027" : helpers.makeTestYear("Asia/Baku", [
		["2027-03-27T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2027-03-28T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2027-10-30T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2027-10-31T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2028" : helpers.makeTestYear("Asia/Baku", [
		["2028-03-25T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2028-03-26T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2028-10-28T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2028-10-29T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2029" : helpers.makeTestYear("Asia/Baku", [
		["2029-03-24T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2029-03-25T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2029-10-27T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2029-10-28T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2030" : helpers.makeTestYear("Asia/Baku", [
		["2030-03-30T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2030-03-31T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2030-10-26T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2030-10-27T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2031" : helpers.makeTestYear("Asia/Baku", [
		["2031-03-29T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2031-03-30T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2031-10-25T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2031-10-26T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2032" : helpers.makeTestYear("Asia/Baku", [
		["2032-03-27T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2032-03-28T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2032-10-30T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2032-10-31T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2033" : helpers.makeTestYear("Asia/Baku", [
		["2033-03-26T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2033-03-27T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2033-10-29T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2033-10-30T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2034" : helpers.makeTestYear("Asia/Baku", [
		["2034-03-25T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2034-03-26T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2034-10-28T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2034-10-29T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2035" : helpers.makeTestYear("Asia/Baku", [
		["2035-03-24T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2035-03-25T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2035-10-27T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2035-10-28T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2036" : helpers.makeTestYear("Asia/Baku", [
		["2036-03-29T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2036-03-30T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2036-10-25T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2036-10-26T00:00:00+00:00", "04:00:00", "AZT", -240]
	]),

	"2037" : helpers.makeTestYear("Asia/Baku", [
		["2037-03-28T23:59:59+00:00", "03:59:59", "AZT", -240],
		["2037-03-29T00:00:00+00:00", "05:00:00", "AZST", -300],
		["2037-10-24T23:59:59+00:00", "04:59:59", "AZST", -300],
		["2037-10-25T00:00:00+00:00", "04:00:00", "AZT", -240]
	])
};