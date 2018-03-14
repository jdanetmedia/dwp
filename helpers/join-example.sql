SELECT movie.title, movie.movieID, appearin.actorID, actor.FirstName, actor.LastName
FROM movie
INNER JOIN appearin
  ON movie.movieID = appearin.movieID
INNER JOIN appearin
  ON appearin.actorID = actor.actorID
