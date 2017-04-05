using System;
using System.Collections.Generic;
using System.IO;
using System.Net;
using System.Runtime.Serialization.Json;
using gitcv.Models.Types;
using Octokit;
using System.Threading.Tasks;

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
            return languages;
        }



        /*public static GithubUser GetUser(string userName)
        {
            var uri = string.Format("https://api.github.com/users/{0}", userName);
            var stream = MakeRequest(uri);
            var serializer = new DataContractJsonSerializer(typeof(GithubUser));
            var user = (GithubUser)serializer.ReadObject(stream);
            stream.Close();
            return user;
        }

        public static List<GithubRepository> GetRepositories(string userName)
        {
            var uri = string.Format("https://api.github.com/users/{0}/repos", userName);
            var stream = MakeRequest(uri);
            var serializer = new DataContractJsonSerializer(typeof(List<GithubRepository>));
            var repos = (List<GithubRepository>)serializer.ReadObject(stream);
            stream.Close();
            return repos;
        }

        public static Dictionary<string, int> GetLanguages(string userName)
        {
            var repos = GithubService.GetRepositories(userName);

            var languages = new Dictionary<string, int>();
            foreach (var repo in repos)
            {
                if (String.IsNullOrEmpty(repo.language))
                {
                    repo.language = "Other";
                }

                if (!languages.ContainsKey(repo.language))
                {
                    languages.Add(repo.language, 1);
                }
                else
                {
                    languages[repo.language]++;
                }
            }
            return languages;
        } 

        private static Stream MakeRequest(string uri)
        {
            ServicePointManager.SecurityProtocol = SecurityProtocolType.Tls12;
            var request = (HttpWebRequest)WebRequest.Create(uri);
            request.UserAgent = "Mozilla/5.0";
            var response = (HttpWebResponse)request.GetResponse();
            return response.GetResponseStream();
        }*/
    }
}