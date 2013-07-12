#include <stdio.h>
#include <vector>

using namespace std;

int N,M;

int shortestPath = INT_MAX;
bool map[5000];

int shortestPath(int a,int b)
{

}

vector<vector<int>> graph;
int main()
{
	graph.resize(5000);
	memset(map,0,sizeof(bool)*5000);
	scanf("%d %d",&N,&M);
	for(int i=0;i<M;i++)
	{
		int a,b;
		scanf("%d %d",&a,&b);
		graph[a].push_back(b);
		graph[b].push_back(a);
	}
	
}