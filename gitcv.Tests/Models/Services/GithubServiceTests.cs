using System.Linq;
using NUnit.Framework;
using gitcv.Models.Services;
using Octokit;

namespace gitcv.Tests.Models.Services
{
    [TestFixture]
    class GithubServiceTests
    {
        [Test]
        public void ShouldReturnUserLoginName()
        {
            var user = GithubService.GetUser("robertgreiner");
            Assert.AreEqual("robertgreiner", user.Login);
        }

        [Test]
        public void ShouldReturnRepositoryInformation()
        {
            var repos = GithubService.GetRepositories("robertgreiner");
            Assert.IsNotEmpty(repos.First().CloneUrl);
            Assert.AreEqual("robertgreiner", repos.First().Owner.Login);
        }

        [Test]
        public void ShouldGetRepositoryLanguages()
        {
            var repos = GithubService.GetRepositories("robertgreiner").ToList();
            var languages = GithubService.GetLanguages(repos);
            Assert.IsTrue(languages.Count > 3);
        }
    }
}
