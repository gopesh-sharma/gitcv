using System.Collections.Generic;
using Octokit;
using System.Linq;

namespace gitcv.Models.Services
{
    public class GithubService
    {

        public GithubService()
        {
            
        }

        public static User GetUser(string userName)
        {
            var client = new GitHubClient(new ProductHeaderValue("my-cool-app"));
            var user = client.User.Get(userName).Result;
            return user;
        }

        public static IReadOnlyList<Repository> GetRepositories(string userName)
        {
            return GetRepo(userName);
        }

        public static List<Repository> GetMainOriginalRepos(List<Repository> repos)
        {
            return repos.Where(a=>a.Fork == false).OrderByDescending(a => a.SubscribersCount).ThenByDescending(a => a.ForksCount).Take(10).ToList();
        }

        public static List<Repository> GetMainForkedRepos(List<Repository> repos)
        {
            return repos.Where(a=>a.Fork == true).OrderByDescending(a => a.SubscribersCount).ThenByDescending(a => a.ForksCount).Take(10).ToList();
        }

        private static IReadOnlyList<Repository> GetRepo(string userName)
        {
            var client = new GitHubClient(new ProductHeaderValue("my-cool-app"));
            var repository = client.Repository.GetAllForUser(userName).Result;
            return repository;
        }

        public static Dictionary<string, int> GetLanguages(List<Repository> repos)
        {
            var languages = new Dictionary<string, int>();
            foreach (var repo in repos)
            {
                if (repo.Language != null)
                {
                    if (!languages.ContainsKey(repo.Language))
                    {
                        languages.Add(repo.Language, 1);
                    }
                    else
                    {
                        languages[repo.Language]++;
                    }
                }
            }
            return languages.OrderByDescending(a => a.Value).Take(10).ToDictionary(a => a.Key, a => a.Value);
        }
    }
}