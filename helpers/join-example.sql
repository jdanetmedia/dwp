-- Get a list of all movies and the actors that appears in the movie
SELECT movie.title, movie.movieID, appearin.actorID, actor.FirstName, actor.LastName
FROM movie
INNER JOIN appearin
  ON movie.movieID = appearin.movieID
INNER JOIN appearin
  ON appearin.actorID = actor.actorID


--  Get a list of all cities in Germany including city name, district and country
SELECT City.Name, City.District, Country.Name
FROM City
INNER JOIN CountryLanguage
	ON City.CountryCode = CountryLanguage.CountryCode
INNER JOIN Country
	ON CountryLanguage.CountryCode = Country.Code
WHERE Country.Name = 'Germany'

-- Get a list of all countries and the languages spoken in that country
SELECT Country.Name, CountryLanguage.Language
FROM Country
INNER JOIN CountryLanguage
	ON CountryLanguage.CountryCode = Country.Code
1